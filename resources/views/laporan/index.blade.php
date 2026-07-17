@extends('layouts.app')

@section('title', 'Laporan - Sistem Desa')

@section('content')
<!-- Google Font Premium -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* COMPACT CONTROLLER */
    .dashboard-compact {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #0f172a;
        background-color: #f8fafc;
        font-size: 14px;
    }

    /* MINI HERO BANNER */
    .mini-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-radius: 16px;
        padding: 20px 24px;
        color: #ffffff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .mini-hero h1 {
        font-size: 1.35rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin: 4px 0;
        color: #ffffff;
    }
    .mini-hero p {
        color: #94a3b8;
        font-size: 0.85rem;
        margin: 0;
    }
    .mini-badge-title {
        color: #6366f1;
        font-weight: 800;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* PREMIUM CONTENT BOX */
    .compact-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.01);
    }

    .box-title {
        margin-top: 0; 
        margin-bottom: 16px; 
        font-size: 1.05rem; 
        color: #0f172a; 
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* COMPACT TABLE STYLING */
    .table-responsive-box {
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        overflow: hidden;
    }
    .compact-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .compact-table th {
        background: #f8fafc;
        padding: 12px 14px;
        font-weight: 700;
        color: #475569;
        font-size: 0.75rem;
        text-transform: uppercase;
        border-bottom: 1px solid #f1f5f9;
    }
    .compact-table td {
        padding: 12px 14px;
        font-size: 0.85rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        transition: background 0.15s ease;
    }
    .compact-table tbody tr:hover td {
        background-color: #f8fafc;
    }
    .compact-table tr:last-child td { border-bottom: none; }

    /* ACTION BUTTONS & PREMIUM BUTTONS */
    .btn-premium {
        background: #0f172a;
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        box-sizing: border-box;
    }
    .btn-premium:hover {
        background: #334155;
        box-shadow: 0 4px 10px rgba(15, 23, 42, 0.15);
    }
    
    .btn-secondary-premium {
        background: #ffffff;
        color: #475569;
        border: 1px solid #cbd5e1;
    }
    .btn-secondary-premium:hover {
        background: #f8fafc;
        color: #1e293b;
    }

    .btn-purple-premium {
        background: #4f46e5;
        color: #ffffff;
    }
    .btn-purple-premium:hover {
        background: #4338ca;
    }

    .action-stack {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .btn-action-mini {
        padding: 6px 12px;
        font-size: 0.75rem;
        border-radius: 6px;
        font-weight: 700;
        text-decoration: none;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.15s ease;
        white-space: nowrap;
    }
    .btn-print-mini { background: #f0f5ff; color: #2563eb; border-color: #dbeafe; }
    .btn-print-mini:hover { background: #dbeafe; }

    .btn-delete-mini { background: #fef2f2; color: #ef4444; border-color: #fee2e2; }
    .btn-delete-mini:hover { background: #fee2e2; }

    /* COUNTER BADGES */
    .count-badge-pill {
        display: inline-flex;
        align-items: center;
        padding: 2px 8px;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 700;
    }
    .count-badge-pill.total { background-color: #f1f5f9; color: #334155; }
    .count-badge-pill.success { background-color: #ecfdf5; color: #065f46; }
    .count-badge-pill.danger { background-color: #fef2f2; color: #991b1b; }

    /* ALERT STYLING */
    .alert-compact {
        padding: 10px 14px;
        border-radius: 10px;
        margin-bottom: 16px;
        font-size: 0.85rem;
        font-weight: 600;
        border: 1px solid #a7f3d0;
        background: #ecfdf3; 
        color: #065f46;
    }
</style>

<div class="dashboard-compact">
    <!-- Mini Hero Banner -->
    <div class="mini-hero">
        <div>
            <span class="mini-badge-title">Arsip & Analitik</span>
            <h1>Laporan Pelayanan Administrasi</h1>
            <p>Rekapitulasi data bulanan dari pengajuan surat yang dapat dievaluasi serta dicetak secara berkala.</p>
        </div>
        <div style="display: flex; gap: 8px;">
            <a href="{{ route('laporan.ttd-bulanan.edit') }}" class="btn-premium btn-secondary-premium" style="border-radius: 10px;">
                <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Pengaturan TTD Bulanan
            </a>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert-compact">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Main Content Box -->
    <div class="compact-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 12px;">
            <h3 class="box-title" style="margin-bottom: 0;">
                <svg style="width:16px; height:16px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Arsip Dokumen Laporan Bulanan
            </h3>
            
            <form method="POST" action="{{ route('laporan.generate') }}">
                @csrf
                <button type="submit" class="btn-premium btn-purple-premium">
                    <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Buat Laporan Bulan Ini
                </button>
            </form>
        </div>
        
        <div class="table-responsive-box" style="overflow-x: auto;">
            <table class="compact-table">
                <thead>
                    <tr>
                        <th>Bulan Pelayanan</th>
                        <th>Tahun Rekap</th>
                        <th style="text-align: center; width: 150px;">Total Pengajuan</th>
                        <th style="text-align: center; width: 150px;">Disetujui</th>
                        <th style="text-align: center; width: 150px;">Ditolak</th>
                        <th style="text-align: center; width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $item)
                        <tr>
                            <td style="font-weight: 700; color: #0f172a;">
                                @if(is_numeric($item->bulan))
                                    {{ \Carbon\Carbon::create()->month($item->bulan)->translatedFormat('F') }}
                                @else
                                    {{ $item->bulan }}
                                @endif
                            </td>
                            <td style="font-weight: 500; color: #475569;">{{ $item->tahun }}</td>
                            <td style="text-align: center;">
                                <span class="count-badge-pill total">{{ $item->total_pengajuan }}</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="count-badge-pill success">{{ $item->total_disetujui }}</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="count-badge-pill danger">{{ $item->total_ditolak }}</span>
                            </td>
                            <td>
                                <div class="action-stack" style="justify-content: center;">
                                    <a href="{{ route('laporan.pdf', $item->id) }}" class="btn-action-mini btn-print-mini" style="display: inline-flex; align-items: center; gap: 4px;">
                                        <svg style="width:12px; height:12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                        Cetak PDF
                                    </a>

                                    <form action="{{ route('laporan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus rekap laporan ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-mini btn-delete-mini">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #94a3b8; padding: 40px 10px; font-size: 0.85rem;">
                                📭 Belum ada rekapitulasi laporan bulanan yang digenerate.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div style="margin-top: 14px; display: flex; justify-content: flex-end;">
            {{ $laporan->links() }}
        </div>
    </div>
</div>
@endsection