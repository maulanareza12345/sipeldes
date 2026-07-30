@extends('layouts.app')

@section('title', 'Arsip Surat - Sistem Desa')

@section('content')
<!-- Google Font Premium -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .dashboard-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #0f172a;
        background-color: #f8fafc;
        font-size: 14px;
        line-height: 1.5;
        padding-bottom: 30px;
    }

    .dashboard-wrapper * { box-sizing: border-box; }

    .mini-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-radius: 14px;
        padding: 20px 24px;
        color: #ffffff;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .mini-hero h1 {
        font-size: 1.3rem;
        font-weight: 800;
        letter-spacing: -0.3px;
        margin: 4px 0 2px 0;
        color: #ffffff;
    }
    .mini-hero p { color: #94a3b8; font-size: 0.85rem; margin: 0; }
    .mini-badge-title {
        color: #60a5fa;
        font-weight: 800;
        font-size: 0.72rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .compact-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 22px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        margin-bottom: 24px;
    }

    .box-title {
        margin: 0 0 16px 0;
        font-size: 1.05rem;
        color: #0f172a;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }

    /* FOLDER GRID */
    .folder-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 12px;
        margin-bottom: 24px;
    }
    .folder-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
        position: relative;
    }
    .folder-card:hover {
        border-color: #0f172a;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
        transform: translateY(-2px);
    }
    .folder-card.active {
        border-color: #0f172a;
        background: #f8fafc;
        box-shadow: 0 0 0 2px rgba(15, 23, 42, 0.1);
    }
    .folder-card .folder-icon { font-size: 2rem; margin-bottom: 6px; }
    .folder-card .folder-name { font-weight: 700; font-size: 0.85rem; color: #0f172a; }
    .folder-card .folder-count {
        display: inline-block;
        margin-top: 6px;
        padding: 2px 10px;
        background: #f1f5f9;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        color: #475569;
    }
    .folder-card.active .folder-count { background: #0f172a; color: #ffffff; }
    .folder-card .folder-all { 
        font-weight: 800; 
        font-size: 0.78rem; 
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* FILTER BAR */
    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: flex-end;
        margin-bottom: 20px;
        padding: 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }
    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
        flex: 1;
        min-width: 150px;
    }
    .filter-group label {
        font-weight: 700;
        font-size: 0.72rem;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .filter-control {
        padding: 7px 10px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 0.85rem;
        background: #ffffff;
        color: #0f172a;
        transition: all 0.2s ease;
        font-family: inherit;
        width: 100%;
    }
    .filter-control:focus {
        outline: none;
        border-color: #0f172a;
        box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
    }
    .filter-actions {
        display: flex;
        gap: 8px;
        align-items: flex-end;
        padding-bottom: 1px;
    }

    .btn {
        padding: 7px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.82rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        font-family: inherit;
        white-space: nowrap;
    }
    .btn-dark { background: #0f172a; color: #ffffff; }
    .btn-dark:hover { background: #1e293b; box-shadow: 0 2px 8px rgba(15, 23, 42, 0.15); }
    .btn-light { background: #f1f5f9; color: #475569; border-color: #cbd5e1; }
    .btn-light:hover { background: #e2e8f0; }
    .btn-success { background: #059669; color: #ffffff; }
    .btn-success:hover { background: #047857; }
    .btn-outline { background: transparent; color: #475569; border-color: #cbd5e1; }
    .btn-outline:hover { background: #f1f5f9; }

    /* TABLE */
    .table-container {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow-x: auto;
        background: #ffffff;
    }
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .data-table th {
        background: #f8fafc;
        padding: 10px 14px;
        font-weight: 700;
        color: #475569;
        font-size: 0.75rem;
        text-transform: uppercase;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }
    .data-table td {
        padding: 10px 14px;
        font-size: 0.85rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    .data-table tbody tr:hover td { background-color: #f8fafc; }
    .data-table tr:last-child td { border-bottom: none; }

    .badge-status {
        display: inline-flex;
        align-items: center;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    .badge-status.disetujui { background: #ccfbf1; color: #0f766e; }

    .action-group {
        display: flex;
        align-items: center;
        gap: 4px;
        flex-wrap: wrap;
    }
    .btn-action {
        padding: 4px 10px;
        font-size: 0.75rem;
        border-radius: 6px;
        font-weight: 700;
        text-decoration: none;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.15s ease;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }
    .btn-action-pdf { background: #f8fafc; color: #475569; border-color: #cbd5e1; }
    .btn-action-pdf:hover { background: #f1f5f9; color: #0f172a; }
    .btn-action-download { background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
    .btn-action-download:hover { background: #dbeafe; }
    .btn-action-history { background: #f0fdf4; color: #059669; border-color: #a7f3d0; }
    .btn-action-history:hover { background: #d1fae5; }

    .info-banner {
        padding: 10px 14px;
        border-radius: 8px;
        margin-bottom: 16px;
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        line-height: 1.4;
    }
    .info-banner.info { background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; }
    .info-banner.success { background: #ecfdf5; border-color: #a7f3d0; color: #065f46; }
    .info-banner.error { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }

    .pagination-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 14px;
        font-size: 0.82rem;
        color: #64748b;
    }

    @media (max-width: 640px) {
        .filter-bar { flex-direction: column; }
        .filter-group { min-width: 100%; }
        .filter-actions { width: 100%; }
        .filter-actions .btn { flex: 1; }
        .folder-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<div class="dashboard-wrapper">
    <!-- Hero Banner -->
    <div class="mini-hero">
        <div>
            <span class="mini-badge-title">Sistem Pengarsipan</span>
            <h1>Arsip Surat Desa</h1>
            <p>Kelola, cari, dan akses kembali surat-surat yang telah diterbitkan.</p>
        </div>
        <div>
            <span style="background: rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08); padding:8px 16px; border-radius:10px; font-size:0.8rem; font-weight:700; color:#cbd5e1;">
                📁 Total: {{ $surats->total() }} Surat
            </span>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="info-banner success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="info-banner error">⚠️ {{ session('error') }}</div>
    @endif

    <!-- FOLDER GRID: Pengelompokan per Jenis Surat -->
    <div class="compact-box">
        <h3 class="box-title">
            <svg style="width:18px; height:18px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
            </svg>
            Folder Berdasarkan Jenis Surat
        </h3>

        <div class="folder-grid">
            <!-- Folder Semua Surat -->
            <a href="{{ route('arsip.index') }}" class="folder-card {{ !request('jenis_surat_id') ? 'active' : '' }}">
                <div class="folder-icon">📁</div>
                <div class="folder-all">Semua Surat</div>
                <div class="folder-count">{{ $surats->total() }}</div>
            </a>

            @foreach($jenisSurats as $js)
                @php $count = $folderCounts[$js->id] ?? 0; @endphp
                @if($count > 0)
                    <a href="{{ route('arsip.index', array_merge(request()->query(), ['jenis_surat_id' => $js->id])) }}" 
                       class="folder-card {{ request('jenis_surat_id') == $js->id ? 'active' : '' }}">
                        <div class="folder-icon">📂</div>
                        <div class="folder-name">{{ $js->nama }}</div>
                        <div class="folder-count">{{ $count }}</div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>

    <!-- FILTER & PENCARIAN -->
    <div class="compact-box">
        <h3 class="box-title">
            <svg style="width:18px; height:18px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            Filter & Pencarian
        </h3>

        <form method="GET" action="{{ route('arsip.index') }}">
            <div class="filter-bar">
                <div class="filter-group">
                    <label>Jenis Surat</label>
                    <select name="jenis_surat_id" class="filter-control">
                        <option value="">— Semua Jenis Surat —</option>
                        @foreach($jenisSurats as $js)
                            <option value="{{ $js->id }}" {{ request('jenis_surat_id') == $js->id ? 'selected' : '' }}>
                                {{ $js->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label>Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" class="filter-control" value="{{ request('tanggal_awal') }}">
                </div>

                <div class="filter-group">
                    <label>Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="filter-control" value="{{ request('tanggal_akhir') }}">
                </div>

                <div class="filter-group" style="flex: 1.5;">
                    <label>Cari Pemohon / No. Surat</label>
                    <input type="text" name="search" class="filter-control" placeholder="Ketik nama pemohon atau nomor surat..." value="{{ request('search') }}">
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn btn-dark">
                        <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari
                    </button>
                    @if(request()->anyFilled(['jenis_surat_id', 'tanggal_awal', 'tanggal_akhir', 'search']))
                        <a href="{{ route('arsip.index') }}" class="btn btn-light">✕ Reset</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- DAFTAR SURAT -->
    <div class="compact-box">
        <h3 class="box-title">
            <svg style="width:18px; height:18px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Daftar Surat Tersimpan
            @if(request('jenis_surat_id'))
                @php $selectedJenis = $jenisSurats->firstWhere('id', request('jenis_surat_id')); @endphp
                @if($selectedJenis)
                    <span style="font-weight: 600; font-size: 0.82rem; color: #64748b; margin-left: 4px;">
                        — {{ $selectedJenis->nama }}
                    </span>
                @endif
            @endif
        </h3>

        @if($surats->isEmpty())
            <div class="info-banner info" style="margin-bottom: 0;">
                📭 Belum ada surat yang tersimpan di arsip ini. 
                @if(request()->anyFilled(['jenis_surat_id', 'tanggal_awal', 'tanggal_akhir', 'search']))
                    Coba ubah filter pencarian Anda.
                @else
                    Surat yang sudah disetujui akan muncul di sini.
                @endif
            </div>
        @else
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No. Surat</th>
                            <th>Pemohon</th>
                            <th>NIK</th>
                            <th>Jenis Surat</th>
                            <th>Tgl. Disetujui</th>
                            <th style="text-align: center; width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surats as $surat)
                            <tr>
                                <td style="font-weight: 700; color: #0f172a; font-size: 0.8rem;">
                                    {{ $surat->nomor_surat ?? '-' }}
                                </td>
                                <td style="font-weight: 600;">
                                    {{ $surat->penduduk->nama ?? '-' }}
                                </td>
                                <td style="color: #64748b; font-size: 0.8rem;">
                                    {{ $surat->penduduk->nik ?? '-' }}
                                </td>
                                <td>
                                    <span style="font-weight: 600; font-size: 0.82rem;">
                                        {{ $surat->jenisSurat->nama ?? '-' }}
                                    </span>
                                </td>
                                <td style="font-size: 0.8rem; color: #475569;">
                                    @if($surat->tanggal_disetujui)
                                        {{ \Carbon\Carbon::parse($surat->tanggal_disetujui)->translatedFormat('d M Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="action-group" style="justify-content: center;">
                                        <a href="{{ route('arsip.show', $surat) }}" class="btn-action btn-action-history" title="Lihat Riwayat Surat">
                                            <svg style="width:12px; height:12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Riwayat
                                        </a>
                                        <a href="{{ route('arsip.download', $surat) }}" class="btn-action btn-action-download" title="Unduh PDF Surat">
                                            <svg style="width:12px; height:12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Unduh
                                        </a>
                                        <a href="{{ route('pengajuan-surat.pdf', $surat) }}" class="btn-action btn-action-pdf" title="Lihat / Cetak PDF" target="_blank">
                                            <svg style="width:12px; height:12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Lihat
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-info">
                <span>Menampilkan {{ $surats->firstItem() ?? 0 }} - {{ $surats->lastItem() ?? 0 }} dari {{ $surats->total() }} surat</span>
                <div>
                    {{ $surats->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
