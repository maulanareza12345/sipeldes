@extends('layouts.app')

@section('title', 'Detail Arsip Surat - Sistem Desa')

@section('content')
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

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    @media (max-width: 640px) { .detail-grid { grid-template-columns: 1fr; } }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .detail-item .label {
        font-size: 0.72rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .detail-item .value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #0f172a;
        padding: 8px 12px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #f1f5f9;
    }

    .badge-status {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    .badge-status.disetujui { background: #ccfbf1; color: #0f766e; }

    .btn {
        padding: 8px 18px;
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
    }
    .btn-dark { background: #0f172a; color: #ffffff; }
    .btn-dark:hover { background: #1e293b; }
    .btn-light { background: #f1f5f9; color: #475569; border-color: #cbd5e1; }
    .btn-light:hover { background: #e2e8f0; }
    .btn-success { background: #059669; color: #ffffff; }
    .btn-success:hover { background: #047857; }
    .btn-outline { background: transparent; color: #475569; border-color: #cbd5e1; }
    .btn-outline:hover { background: #f1f5f9; }

    .action-bar {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
        margin-top: 16px;
    }

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

    .timeline {
        position: relative;
        padding-left: 24px;
        margin: 16px 0;
    }
    .timeline::before {
        content: '';
        position: absolute;
        left: 8px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e2e8f0;
    }
    .timeline-item {
        position: relative;
        padding-bottom: 20px;
    }
    .timeline-item:last-child { padding-bottom: 0; }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -20px;
        top: 4px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #ffffff;
        border: 2px solid #0f172a;
    }
    .timeline-item .tl-title { font-weight: 700; font-size: 0.88rem; color: #0f172a; }
    .timeline-item .tl-date { font-size: 0.78rem; color: #64748b; }
    .timeline-item .tl-desc { font-size: 0.82rem; color: #475569; margin-top: 2px; }
</style>

<div class="dashboard-wrapper">
    <!-- Hero Banner -->
    <div class="mini-hero">
        <div>
            <span class="mini-badge-title">Detail Arsip</span>
            <h1>Riwayat Surat</h1>
            <p>Informasi lengkap dan riwayat surat yang telah diterbitkan.</p>
        </div>
        <a href="{{ route('arsip.index') }}" class="btn btn-light" style="background: rgba(255,255,255,0.1); color: #ffffff; border-color: rgba(255,255,255,0.2);">
            ← Kembali ke Arsip
        </a>
    </div>

    <!-- Informasi Surat -->
    <div class="compact-box">
        <h3 class="box-title">
            <svg style="width:18px; height:18px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Informasi Surat
        </h3>

        <div class="detail-grid">
            <div class="detail-item">
                <span class="label">Nomor Surat</span>
                <span class="value" style="font-weight: 800;">{{ $pengajuanSurat->nomor_surat ?? '-' }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Status</span>
                <span class="value">
                    <span class="badge-status disetujui">✅ Disetujui</span>
                </span>
            </div>
            <div class="detail-item">
                <span class="label">Jenis Surat</span>
                <span class="value">{{ $pengajuanSurat->jenisSurat->nama ?? '-' }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Tanggal Disetujui</span>
                <span class="value">
                    @if($pengajuanSurat->tanggal_disetujui)
                        {{ \Carbon\Carbon::parse($pengajuanSurat->tanggal_disetujui)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </span>
            </div>
        </div>
    </div>

    <!-- Data Pemohon -->
    <div class="compact-box">
        <h3 class="box-title">
            <svg style="width:18px; height:18px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            Data Pemohon
        </h3>

        <div class="detail-grid">
            <div class="detail-item">
                <span class="label">Nama Lengkap</span>
                <span class="value">{{ $pengajuanSurat->penduduk->nama ?? '-' }}</span>
            </div>
            <div class="detail-item">
                <span class="label">NIK</span>
                <span class="value">{{ $pengajuanSurat->penduduk->nik ?? '-' }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Tempat, Tanggal Lahir</span>
                <span class="value">
                    @if($pengajuanSurat->penduduk->tempat_lahir && $pengajuanSurat->penduduk->tanggal_lahir)
                        {{ $pengajuanSurat->penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($pengajuanSurat->penduduk->tanggal_lahir)->translatedFormat('d F Y') }}
                    @elseif($pengajuanSurat->penduduk->tempat_lahir)
                        {{ $pengajuanSurat->penduduk->tempat_lahir }}
                    @elseif($pengajuanSurat->penduduk->tanggal_lahir)
                        {{ \Carbon\Carbon::parse($pengajuanSurat->penduduk->tanggal_lahir)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </span>
            </div>
            <div class="detail-item">
                <span class="label">Jenis Kelamin</span>
                <span class="value">{{ $pengajuanSurat->penduduk->jenis_kelamin ?? '-' }}</span>
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <span class="label">Alamat</span>
                <span class="value">{{ $pengajuanSurat->penduduk->alamat ?? '-' }}</span>
            </div>
        </div>
    </div>

    <!-- Data Surat Khusus (data_fields) -->
    @if($pengajuanSurat->data_fields && count($pengajuanSurat->data_fields) > 0)
    <div class="compact-box">
        <h3 class="box-title">
            <svg style="width:18px; height:18px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
            </svg>
            Data Khusus Surat
        </h3>

        <div class="detail-grid">
            @foreach($pengajuanSurat->data_fields as $key => $value)
                @if(is_array($value))
                    @continue
                @endif
                <div class="detail-item">
                    <span class="label">{{ ucwords(str_replace('_', ' ', $key)) }}</span>
                    <span class="value">{{ $value ?? '-' }}</span>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Riwayat / Timeline -->
    <div class="compact-box">
        <h3 class="box-title">
            <svg style="width:18px; height:18px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Riwayat Surat
        </h3>

        <div class="timeline">
            <div class="timeline-item">
                <div class="tl-title">📄 Pengajuan Dibuat</div>
                <div class="tl-date">
                    {{ \Carbon\Carbon::parse($pengajuanSurat->tanggal_pengajuan ?? $pengajuanSurat->created_at)->translatedFormat('d F Y H:i') }}
                </div>
                <div class="tl-desc">
                    Diajukan oleh: <strong>{{ $pengajuanSurat->user->name ?? 'Sistem' }}</strong>
                </div>
            </div>

            <div class="timeline-item">
                <div class="tl-title">✅ Surat Disetujui</div>
                <div class="tl-date">
                    @if($pengajuanSurat->tanggal_disetujui)
                        {{ \Carbon\Carbon::parse($pengajuanSurat->tanggal_disetujui)->translatedFormat('d F Y H:i') }}
                    @else
                        -
                    @endif
                </div>
                <div class="tl-desc">
                    Nomor Surat: <strong>{{ $pengajuanSurat->nomor_surat ?? '-' }}</strong>
                </div>
                @if($pengajuanSurat->catatan_admin)
                    <div class="tl-desc" style="margin-top: 4px; padding: 6px 10px; background: #f0fdf4; border-radius: 6px; border: 1px solid #bbf7d0;">
                        📝 Catatan: {{ $pengajuanSurat->catatan_admin }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Action Bar -->
    <div class="compact-box" style="padding: 16px 22px;">
        <div class="action-bar">
            <a href="{{ route('arsip.download', $pengajuanSurat) }}" class="btn btn-success">
                <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Unduh PDF
            </a>
            <a href="{{ route('pengajuan-surat.pdf', $pengajuanSurat) }}" class="btn btn-dark" target="_blank">
                <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                Lihat PDF
            </a>
            <a href="{{ route('arsip.index') }}" class="btn btn-outline">
                ← Kembali ke Arsip
            </a>
        </div>
    </div>
</div>
@endsection
