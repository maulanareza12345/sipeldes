<?php

namespace App\Http\Controllers;

use App\Models\LaporanPelayanan;
use App\Models\LaporanTtdBulanan;
use App\Models\PengajuanSurat;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPelayananController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,perangkat']);
    }

    public function index()
    {
        $laporan = LaporanPelayanan::latest()->paginate(10);

        if ($laporan->isEmpty()) {
            $this->generate();
            $laporan = LaporanPelayanan::latest()->paginate(10);
        }

        return view('laporan.index', compact('laporan'));
    }

    public function generate()
    {
        $bulan = now()->month;
        $tahun = now()->year;

        $total = PengajuanSurat::count();
        $disetujui = PengajuanSurat::where('status', 'disetujui')->count();
        $ditolak = PengajuanSurat::where('status', 'ditolak')->count();

        LaporanPelayanan::create([
            'bulan' => $bulan,
            'tahun' => $tahun,
            'total_pengajuan' => $total,
            'total_disetujui' => $disetujui,
            'total_ditolak' => $ditolak,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan pelayanan berhasil dibuat.');
    }

    public function pdf(LaporanPelayanan $laporanPelayanan)
    {
        $ttd = LaporanTtdBulanan::query()
            ->where('bulan', $laporanPelayanan->bulan)
            ->where('tahun', $laporanPelayanan->tahun)
            ->first();

        $pdf = Pdf::loadView('laporan.pdf', [
            'laporan' => $laporanPelayanan,
            'ttd' => $ttd,
        ]);

        return $pdf->download('laporan-' . $laporanPelayanan->tahun . '-' . $laporanPelayanan->bulan . '.pdf');
    }
}

