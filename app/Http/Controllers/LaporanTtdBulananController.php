<?php

namespace App\Http\Controllers;

use App\Models\LaporanPelayanan;
use App\Models\LaporanTtdBulanan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LaporanTtdBulananController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,perangkat']);
    }

    public function edit()
    {
        $now = Carbon::now();

        return view('laporan.ttd-bulanan', [
            'bulan' => $now->month,
            'tahun' => $now->year,
            'rows' => LaporanTtdBulanan::orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->paginate(10),
            'current' => LaporanTtdBulanan::where('bulan', $now->month)->where('tahun', $now->year)->first(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'bulan' => ['required', 'integer', 'min:1', 'max:12'],
            'tahun' => ['required', 'integer', 'min:1900', 'max:2100'],
            'nama_ttd' => ['required', 'string', 'max:255'],
            'jabatan_ttd' => ['required', 'string', 'max:255'],
        ]);

        LaporanTtdBulanan::updateOrCreate(
            [
                'bulan' => $data['bulan'],
                'tahun' => $data['tahun'],
            ],
            [
                'nama_ttd' => $data['nama_ttd'],
                'jabatan_ttd' => $data['jabatan_ttd'],
            ]
        );

        return redirect()->route('laporan.ttd-bulanan.edit')->with('success', 'TTD bulanan berhasil disimpan.');
    }

    public function destroy(LaporanPelayanan $laporanPelayanan)
    {
        $laporanPelayanan->delete();

        return redirect()->route('laporan.index')->with('success', 'Rekap laporan berhasil dihapus.');
    }
}

