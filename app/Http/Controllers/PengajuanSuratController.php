<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\Penduduk;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class PengajuanSuratController extends Controller
{
    /**
     * Mapping format nomor surat berdasarkan nama jenis surat.
     * Key adalah nama jenis surat (case-sensitive).
     * {no_surat} adalah placeholder yang akan diganti dengan nomor urut (001, 002, dst).
     */
    protected static $nomorSuratFormats = [
        'Surat Serbaguna'                            => '472/{no_surat}/VII/umum',
        'Surat Keterangan Usaha'                     => '570/{no_surat}/VII/kesra',
        'Surat Keterangan Domisili'                  => '470/{no_surat}/VII/pem',
        'Surat Domisili Usaha'                       => '503/{no_surat}/VII/pem',
        'Surat Keterangan Kelahiran'                 => '474.1/{no_surat}/VII/Rem',
        'Surat Keterangan Kematian'                  => '474.3/{no_surat}/VII/pem',
        'Surat Pengantar Nikah'                      => '474.2/{no_surat}/VII/pem',
        'PSKS'                                       => '400/{no_surat}/puskesos/VII/kesra',
        'Surat Keterangan Belum Menikah'             => '471/{no_surat}/VII/pem',
        'Surat Keterangan Janda/Duda'                => '472.2/{no_surat}/VII/pem',
        'Surat Pindah'                               => '141/{no_surat}/VIII/PEM',
    ];

    /**
     * Ambil format nomor surat untuk nama jenis surat tertentu.
     * Gunakan fallback default jika tidak tercantum di daftar.
     */
    public static function getNomorFormatFor(?string $namaJenisSurat): string
    {
        if ($namaJenisSurat && array_key_exists($namaJenisSurat, static::$nomorSuratFormats)) {
            return static::$nomorSuratFormats[$namaJenisSurat];
        }
        // Fallback default
        return '400/{no_surat}/VII/pem';
    }

    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,perangkat']);
    }

    public function index()
    {
        $pengajuanSurats = PengajuanSurat::with(['penduduk', 'jenisSurat', 'user'])->latest()->paginate(10);
        $penduduks = Penduduk::all();
        $jenisSurats = JenisSurat::all();

        // Load fields_config for each jenis surat, grouped by id for dynamic form JS
        $fieldConfigs = [];
        foreach ($jenisSurats as $js) {
            if ($js->fields_config) {
                $fieldConfigs[$js->id] = $js->fields_config;
            }
        }

        // Build nomor surat format per option (keyed by jenis_surat nama)
        $nomorSuratFormats = [];
        foreach ($jenisSurats as $js) {
            $nomorSuratFormats[$js->nama] = static::getNomorFormatFor($js->nama);
        }

        return view('pengajuan-surat.index', compact('pengajuanSurats', 'penduduks', 'jenisSurats', 'fieldConfigs', 'nomorSuratFormats'));
    }

    public function store(Request $request)
    {
        $baseRules = [
            'penduduk_id' => ['required', 'exists:penduduks,id'],
            'jenis_surat_id' => ['required', 'exists:jenis_surats,id'],

            'keterangan' => ['nullable', 'string'],

            // Dokumen wajib
            'foto_ktp' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'foto_kk' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],

            // Input untuk validasi otomatis (tanpa OCR)
            'nik_ktp' => ['required', 'digits:16'],
            'nik_kk' => ['required', 'digits:16'],

            // Surat Pengantar dari RT/RW - akan di-override conditional di bawah
            'surat_pengantar_rt_rw' => ['nullable', 'string'],

            // ttd (opsional)
            'nama_ttd' => ['nullable', 'string', 'max:255'],
            'jabatan_ttd' => ['nullable', 'string', 'max:255'],
        ];

        // Add dynamic field validation based on selected jenis_surat
        $jenisSurat = JenisSurat::find($request->jenis_surat_id);

        // Conditional validation for surat_pengantar_rt_rw based on jenis surat
        if ($jenisSurat) {
            if ($jenisSurat->surat_pengantar === 'wajib') {
                $baseRules['surat_pengantar_rt_rw'] = ['required', 'string'];
            } elseif ($jenisSurat->surat_pengantar === 'tidak_perlu') {
                $baseRules['surat_pengantar_rt_rw'] = ['nullable', 'string'];
                // Remove from request entirely if not needed
                $request->request->remove('surat_pengantar_rt_rw');
            }
            // 'opsional' stays as nullable
        }

        $dynamicFieldRules = [];
        if ($jenisSurat && $jenisSurat->fields_config) {
            foreach ($jenisSurat->fields_config as $field) {
                $fieldName = 'dynamic_' . $field['name'];
                $rules = [];
                if (!empty($field['required'])) {
                    $rules[] = 'required';
                } else {
                    $rules[] = 'nullable';
                }
                $rules[] = 'string';
                if ($field['type'] === 'date') {
                    $rules[] = 'date';
                }
                if ($field['type'] === 'select' && !empty($field['options'])) {
                    $rules[] = 'in:' . implode(',', $field['options']);
                }
                $dynamicFieldRules[$fieldName] = $rules;
            }
        }

        $data = $request->validate(array_merge($baseRules, $dynamicFieldRules));

        $penduduk = Penduduk::query()->findOrFail($data['penduduk_id']);

        // Normalisasi NIK
        $nikKtp = (string) $data['nik_ktp'];
        $nikKk = (string) $data['nik_kk'];
        $nikPenduduk = (string) ($penduduk->nik ?? '');

        // Validasi otomatis
        if ($nikKtp !== $nikKk) {
            return back()
                ->withErrors(['nik_ktp' => 'NIK KTP dan NIK KK tidak sesuai/tidak cocok.'])
                ->withInput();
        }

        if ($nikPenduduk === '' || $nikKtp !== $nikPenduduk) {
            return back()
                ->withErrors(['nik_ktp' => 'NIK pada KTP/KK tidak sesuai dengan data penduduk terpilih.'])
                ->withInput();
        }

        // Simpan file dokumen
        $folder = 'pengajuan-surats/' . auth()->id() . '/' . now()->format('Ymd_His');

        $fotoKtpPath = $request->file('foto_ktp')->store($folder . '/dokumen', 'public');
        $fotoKkPath = $request->file('foto_kk')->store($folder . '/dokumen', 'public');

        // Collect dynamic fields data
        $dataFields = [];
        if ($jenisSurat && $jenisSurat->fields_config) {
            foreach ($jenisSurat->fields_config as $field) {
                $fieldName = 'dynamic_' . $field['name'];
                $dataFields[$field['name']] = $data[$fieldName] ?? null;
            }
        }

        $createData = [
            'penduduk_id' => $data['penduduk_id'],
            'jenis_surat_id' => $data['jenis_surat_id'],
            'user_id' => auth()->id(),

            'keterangan' => $data['keterangan'] ?? null,
            'data_fields' => !empty($dataFields) ? $dataFields : null,
            'surat_pengantar_rt_rw' => $data['surat_pengantar_rt_rw'] ?? null,

            'foto_ktp' => $fotoKtpPath,
            'foto_kk' => $fotoKkPath,

            'nik_ktp' => $nikKtp,
            'nik_kk' => $nikKk,

            'nama_ttd' => $data['nama_ttd'] ?? null,
            'jabatan_ttd' => $data['jabatan_ttd'] ?? null,

            'status' => 'pending',
            'tanggal_pengajuan' => now()->toDateString(),
        ];

        PengajuanSurat::create($createData);

        return redirect()->route('pengajuan-surat.index')->with('success', 'Pengajuan surat berhasil dikirim.');
    }

    public function approve(PengajuanSurat $pengajuanSurat)
    {
// Penomoran otomatis reset per tahun (urut berdasarkan jumlah pengajuan yang disetujui pada tahun tsb)
        $tahun = date('Y');
        $tanggalDisetujui = now()->toDateString();

        // Urutkan nomor surat per jenis_surat, reset mulai 1 tiap tahun
        $urut = PengajuanSurat::whereYear('tanggal_disetujui', $tahun)
            ->where('jenis_surat_id', $pengajuanSurat->jenis_surat_id)
            ->where('status', 'disetujui')
            ->count() + 1;

        // Nomor urut ber-padding 3 digit (001, 002, dst)
        $noSurat = str_pad((string) $urut, 3, '0', STR_PAD_LEFT);

        // Program nomor sesuai format per jenis surat
        $format = static::getNomorFormatFor($pengajuanSurat->jenisSurat->nama ?? null);
        $nomorSurat = str_replace('{no_surat}', $noSurat, $format);

        $pengajuanSurat->update([
            'status' => 'disetujui',
            'tanggal_disetujui' => $tanggalDisetujui,
            'nomor_surat' => $nomorSurat,
            'catatan_admin' => 'Disetujui melalui sistem.',
        ]);

        return back()->with('success', 'Pengajuan surat berhasil disetujui.');
    }

    public function reject(Request $request, PengajuanSurat $pengajuanSurat)
    {
        $pengajuanSurat->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->input('catatan_admin', 'Ditolak melalui sistem.'),
        ]);

        return back()->with('success', 'Pengajuan surat berhasil ditolak.');
    }

    public function searchPenduduk(Request $request)
    {
        $query = (string) $request->input('query', '');
        $query = trim($query);

        if ($query === '') {
            return response()->json([]);
        }

        $results = Penduduk::query()
            ->where(function ($q) use ($query) {
                $q->where('nama', 'like', '%' . $query . '%')
                    ->orWhere('nik', 'like', '%' . $query . '%');
            })
            ->orderBy('nama')
            ->limit(8)
            ->get(['id', 'nama', 'nik']);

        return response()->json($results);
    }

    public function destroy(PengajuanSurat $pengajuanSurat)
    {
        $pengajuanSurat->delete();

        return back()->with('success', 'Pengajuan surat berhasil dihapus.');
    }

    public function pdf(PengajuanSurat $pengajuanSurat)
    {
// Pastikan nomor surat selalu terisi sebelum PDF dibuat
        if (empty($pengajuanSurat->nomor_surat)) {
            $format = static::getNomorFormatFor($pengajuanSurat->jenisSurat->nama ?? null);
            $noSurat = str_pad((string) $pengajuanSurat->id, 3, '0', STR_PAD_LEFT);
            $pengajuanSurat->update([
                'nomor_surat' => str_replace('{no_surat}', $noSurat, $format),
            ]);
        }

        $pdf = Pdf::loadView('pengajuan-surat.pdf', [
            'pengajuan' => $pengajuanSurat->load(['penduduk', 'jenisSurat', 'user']),
        ]);

        return $pdf->download('surat-' . $pengajuanSurat->id . '.pdf');
    }
}

