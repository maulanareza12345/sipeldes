<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipSuratController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,perangkat']);
    }

    /**
     * Menampilkan halaman arsip surat dengan filter & pencarian.
     */
    public function index(Request $request)
    {
        $jenisSurats = JenisSurat::all();

        // Query dasar: hanya surat yang sudah disetujui
        $query = PengajuanSurat::with(['penduduk', 'jenisSurat', 'user'])
            ->where('status', 'disetujui');

        // Filter berdasarkan jenis surat
        if ($request->filled('jenis_surat_id')) {
            $query->where('jenis_surat_id', $request->jenis_surat_id);
        }

        // Filter berdasarkan tanggal (range)
        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tanggal_disetujui', '>=', $request->tanggal_awal);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal_disetujui', '<=', $request->tanggal_akhir);
        }

        // Pencarian berdasarkan nama pemohon atau nomor surat
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_surat', 'like', '%' . $search . '%')
                  ->orWhereHas('penduduk', function ($q2) use ($search) {
                      $q2->where('nama', 'like', '%' . $search . '%')
                         ->orWhere('nik', 'like', '%' . $search . '%');
                  });
            });
        }

        // Urutkan berdasarkan tanggal disetujui (terbaru)
        $surats = $query->orderBy('tanggal_disetujui', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(15)
                        ->withQueryString();

        // Hitung jumlah surat per jenis surat (untuk tampilan folder)
        $folderCounts = PengajuanSurat::where('status', 'disetujui')
            ->selectRaw('jenis_surat_id, COUNT(*) as total')
            ->groupBy('jenis_surat_id')
            ->pluck('total', 'jenis_surat_id');

        return view('arsip.index', compact(
            'jenisSurats',
            'surats',
            'folderCounts'
        ));
    }

    /**
     * Menampilkan detail/riwayat surat tertentu.
     */
    public function show(PengajuanSurat $pengajuanSurat)
    {
        // Pastikan hanya surat yang disetujui bisa dilihat detailnya
        if ($pengajuanSurat->status !== 'disetujui') {
            return redirect()->route('arsip.index')
                ->with('error', 'Surat yang belum disetujui tidak dapat diakses di arsip.');
        }

        $pengajuanSurat->load(['penduduk', 'jenisSurat', 'user']);

        return view('arsip.show', compact('pengajuanSurat'));
    }

    /**
     * Mengunduh ulang file PDF surat.
     */
    public function download(PengajuanSurat $pengajuanSurat)
    {
        if ($pengajuanSurat->status !== 'disetujui') {
            return redirect()->route('arsip.index')
                ->with('error', 'Surat yang belum disetujui tidak dapat diunduh.');
        }

        // Generate PDF dan download
        $pdf = Pdf::loadView('pengajuan-surat.pdf', [
            'pengajuan' => $pengajuanSurat->load(['penduduk', 'jenisSurat', 'user']),
        ]);

        $filename = 'surat-' . ($pengajuanSurat->nomor_surat ?? $pengajuanSurat->id) . '.pdf';
        // Bersihkan karakter yang tidak valid untuk filename
        $filename = preg_replace('/[^a-zA-Z0-9\-_\.]/', '_', $filename);

        return $pdf->download($filename);
    }
}

