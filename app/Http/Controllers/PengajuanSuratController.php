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
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,perangkat']);
    }

    public function index()
    {
        $pengajuanSurats = PengajuanSurat::with(['penduduk', 'jenisSurat', 'user'])->latest()->paginate(10);
        $penduduks = Penduduk::all();
        $jenisSurats = JenisSurat::all();

        return view('pengajuan-surat.index', compact('pengajuanSurats', 'penduduks', 'jenisSurats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'penduduk_id' => ['required', 'exists:penduduks,id'],
            'jenis_surat_id' => ['required', 'exists:jenis_surats,id'],

            'keterangan' => ['nullable', 'string'],

            // Dokumen wajib
            'foto_ktp' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'foto_kk' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],

            // Input untuk validasi otomatis (tanpa OCR)
            'nik_ktp' => ['required', 'digits:16'],
            // Untuk pengajuan KK gunakan nomor KK (bukan NIK). Di sistem ini field-nya tetap disimpan di kolom nik_kk.
            'nik_kk' => ['required', 'digits:16'],

            // Surat Pengantar dari RT/RW (WAJIB ditampilkan di PDF)
            'surat_pengantar_rt_rw' => ['required', 'string'],

            // ttd (opsional)
            'nama_ttd' => ['nullable', 'string', 'max:255'],
            'jabatan_ttd' => ['nullable', 'string', 'max:255'],
        ]);

        $penduduk = Penduduk::query()->findOrFail($data['penduduk_id']);

        // Normalisasi NIK (digits:16 sudah memastikan digit, tapi tetap pastikan string)
        $nikKtp = (string) $data['nik_ktp'];
        $nikKk = (string) $data['nik_kk'];
        $nikPenduduk = (string) ($penduduk->nik ?? '');

        // Validasi otomatis: KK dan KTP harus cocok + harus cocok dengan penduduk terpilih
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

        $createData = [
            'penduduk_id' => $data['penduduk_id'],
            'jenis_surat_id' => $data['jenis_surat_id'],
            'user_id' => auth()->id(),

            'keterangan' => $data['keterangan'] ?? null,
            'surat_pengantar_rt_rw' => $data['surat_pengantar_rt_rw'],

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

        $pengajuanSurat->update([
            'status' => 'disetujui',
            'tanggal_disetujui' => $tanggalDisetujui,
            'nomor_surat' => 'BJB/' . $tahun . '/' . str_pad((string) $urut, 4, '0', STR_PAD_LEFT),
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
            $pengajuanSurat->update([
                'nomor_surat' => 'BJB/' . date('Y') . '/' . str_pad((string) $pengajuanSurat->id, 4, '0', STR_PAD_LEFT),
            ]);
        }

        $pdf = Pdf::loadView('pengajuan-surat.pdf', [
            'pengajuan' => $pengajuanSurat->load(['penduduk', 'jenisSurat', 'user']),
        ]);

        return $pdf->download('surat-' . $pengajuanSurat->id . '.pdf');
    }
}

