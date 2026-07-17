<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\PengajuanSurat;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,perangkat']);
    }

    public function index()
    {
        $totalPenduduk = Penduduk::count();
        $totalPengajuan = PengajuanSurat::count();
        $disetujui = PengajuanSurat::where('status', 'disetujui')->count();
        $pending = PengajuanSurat::where('status', 'pending')->count();
        $ditolak = PengajuanSurat::where('status', 'ditolak')->count();

        $recent = PengajuanSurat::with(['penduduk', 'jenisSurat'])->latest()->take(5)->get();

        return view('dashboard.index', compact('totalPenduduk', 'totalPengajuan', 'disetujui', 'pending', 'ditolak', 'recent'));
    }
}
