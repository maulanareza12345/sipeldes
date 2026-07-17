@extends('layouts.app')

@section('title', 'Dashboard - Sistem Desa')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* COMPACT CONTROLLER */
    .dashboard-compact {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #0f172a;
        background-color: #f8fafc;
        font-size: 14px; /* Default font base disusutkan */
    }

    /* MINI HERO BANNER */
    .mini-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-radius: 16px;
        padding: 20px 28px;
        color: #ffffff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.1);
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
    .mini-date {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
        padding: 8px 16px;
        border-radius: 10px;
        text-align: right;
        font-size: 0.8rem;
        font-weight: 700;
        color: #cbd5e1;
    }

    /* COMPACT FIVE-ROW STACK CARD */
    .compact-stats-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }
    @media (max-width: 1200px) { .compact-stats-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 768px) { .compact-stats-grid { grid-template-columns: repeat(1, 1fr); } }

    .stat-card-mini {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.2s ease;
    }
    .stat-card-mini:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04);
        border-color: #cbd5e1;
    }
    .stat-card-mini .label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-card-mini .value {
        font-size: 1.45rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-top: 2px;
        line-height: 1.2;
    }
    .mini-badge-icon {
        font-size: 1.25rem;
        width: 32px;
        height: 32px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    /* MAIN SYSTEM GRID SPLIT */
    .compact-main-layout {
        display: grid;
        grid-template-columns: 1.7fr 1fr;
        gap: 20px;
    }
    @media (max-width: 1024px) { .compact-main-layout { grid-template-columns: 1fr; } }

    .compact-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
    }

    /* HIGH-DENSITY TABLE */
    .table-responsive-box {
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        overflow: hidden;
        margin-top: 14px;
    }
    .compact-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .compact-table th {
        background: #f8fafc;
        padding: 10px 14px;
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
        transition: background 0.15s ease;
    }
    .compact-table tbody tr:hover td {
        background-color: #f8fafc;
    }
    .compact-table tr:last-child td { border-bottom: none; }

    /* SLEEK MINI BADGES */
    .badge-mini {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    .badge-mini::before {
        content: ''; width: 5px; height: 5px; border-radius: 50%; background-color: currentColor;
    }
    .badge-mini.disetujui { background: #d1fae5; color: #065f46; }
    .badge-mini.pending { background: #fef3c7; color: #92400e; }
    .badge-mini.ditolak { background: #fee2e2; color: #991b1b; }

    /* MINI BUTTON */
    .btn-action-mini {
        background: #0f172a;
        color: #ffffff;
        padding: 6px 14px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-action-mini:hover {
        background: #334155;
        box-shadow: 0 4px 10px rgba(15, 23, 42, 0.15);
    }
</style>

<div class="dashboard-compact">
    <div class="mini-hero">
        <div>
            <span style="color:#60a5fa; font-weight:800; font-size:0.75rem; letter-spacing: 0.5px; text-transform:uppercase;">Sistem Informasi Desa</span>
            <h1>Dashboard Pelayanan Administrasi</h1>
            <p>Ringkasan berkas masuk dan status dokumen warga secara real-time.</p>
        </div>
        <div class="mini-date">
            📅 {{ now()->translatedFormat('d F Y') }}
        </div>
    </div>

    <div class="compact-stats-grid">
        <div class="stat-card-mini" style="border-left: 3px solid #0ea5e9;">
            <div>
                <div class="label">Penduduk</div>
                <div class="value" style="color: #0284c7;">{{ $totalPenduduk }}</div>
            </div>
            <div class="mini-badge-icon" style="background:#e0f2fe;">👥</div>
        </div>
        <div class="stat-card-mini" style="border-left: 3px solid #4f46e5;">
            <div>
                <div class="label">Pengajuan</div>
                <div class="value" style="color: #4f46e5;">{{ $totalPengajuan }}</div>
            </div>
            <div class="mini-badge-icon" style="background:#e0e7ff;">📩</div>
        </div>
        <div class="stat-card-mini" style="border-left: 3px solid #10b981;">
            <div>
                <div class="label">Disetujui</div>
                <div class="value" style="color: #059669;">{{ $disetujui }}</div>
            </div>
            <div class="mini-badge-icon" style="background:#d1fae5;">✅</div>
        </div>
        <div class="stat-card-mini" style="border-left: 3px solid #f59e0b;">
            <div>
                <div class="label">Pending</div>
                <div class="value" style="color: #d97706;">{{ $pending }}</div>
            </div>
            <div class="mini-badge-icon" style="background:#fef3c7;">⏳</div>
        </div>
        <div class="stat-card-mini" style="border-left: 3px solid #ef4444;">
            <div>
                <div class="label">Ditolak</div>
                <div class="value" style="color: #dc2626;">{{ $ditolak }}</div>
            </div>
            <div class="mini-badge-icon" style="background:#fee2e2;">❌</div>
        </div>
    </div>

    <div class="compact-main-layout">
        
        <div class="compact-box">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="margin: 0; font-size: 1.05rem; font-weight: 800;">Pengajuan Terbaru</h3>
                </div>
                <a href="{{ route('pengajuan-surat.index') }}" class="btn-action-mini">Lihat Semua</a>
            </div>

            <div class="table-responsive-box" style="overflow-x: auto;">
                <table class="compact-table">
                    <thead>
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Pemohon</th>
                            <th>Jenis Surat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent as $row)
                            <tr>
                                <td style="font-weight: 700; color: #0f172a;">{{ $row->nomor_surat ?? '-' }}</td>
                                <td style="font-weight: 600;">{{ $row->penduduk->nama ?? '-' }}</td>
                                <td style="color: #475569;">{{ $row->jenisSurat->nama ?? '-' }}</td>
                                <td>
                                    <span class="badge-mini {{ Str::lower($row->status) }}">
                                        {{ $row->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; color: #94a3b8; padding: 40px 10px; font-size: 0.8rem;">
                                    📭 Belum ada antrean pengajuan berkas baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="compact-box" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <h3 style="margin:0; font-size: 1.05rem; font-weight: 800;">Rasio Berkas</h3>
            </div>

            <div style="height: 140px; position: relative; margin: 10px 0;">
                <canvas id="statusPie"></canvas>
            </div>

            <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap: 6px; margin-top: 10px;">
                <div style="text-align:center; padding: 6px; background:#f8fafc; border-radius:10px; border: 1px solid #f1f5f9;">
                    <div style="font-size: 0.7rem; font-weight: 700; color: #059669;">Disetujui</div>
                    <div style="font-weight: 800; font-size: 1rem; color: #334155;">{{ $disetujui }}</div>
                </div>
                <div style="text-align:center; padding: 6px; background:#f8fafc; border-radius:10px; border: 1px solid #f1f5f9;">
                    <div style="font-size: 0.7rem; font-weight: 700; color: #d97706;">Pending</div>
                    <div style="font-weight: 800; font-size: 1rem; color: #334155;">{{ $pending }}</div>
                </div>
                <div style="text-align:center; padding: 6px; background:#f8fafc; border-radius:10px; border: 1px solid #f1f5f9;">
                    <div style="font-size: 0.7rem; font-weight: 700; color: #dc2626;">Ditolak</div>
                    <div style="font-weight: 800; font-size: 1rem; color: #334155;">{{ $ditolak }}</div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    (function(){
        const canvas = document.getElementById('statusPie');
        if(!canvas) return;

        const disetujui = {{ (int) $disetujui }};
        const pending = {{ (int) $pending }};
        const ditolak = {{ (int) $ditolak }};
        const total = disetujui + pending + ditolak;

        const data = {
            labels: ['Disetujui', 'Pending', 'Ditolak'],
            datasets: [{
                data: [disetujui, pending, ditolak],
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                borderWidth: 4,
                borderColor: '#ffffff',
                hoverBorderColor: '#ffffff'
            }]
        };

        const centerTextPlugin = {
            id: 'centerText',
            beforeDraw(chart) {
                const { width, height, ctx } = chart;
                ctx.restore();
                
                // Number
                ctx.font = `800 ${Math.round(height / 4)}px 'Plus Jakarta Sans'`;
                ctx.textBaseline = "middle";
                ctx.fillStyle = "#0f172a";
                const numText = total.toString();
                const numX = Math.round((width - ctx.measureText(numText).width) / 2);
                const numY = height / 2;
                ctx.fillText(numText, numX, numY);
                ctx.save();
            }
        };

        const opts = {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '82%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    padding: 8,
                    backgroundColor: '#0f172a',
                    titleFont: { family: 'Plus Jakarta Sans', size: 11, weight: 'bold' },
                    bodyFont: { family: 'Plus Jakarta Sans', size: 11 },
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(ctx){
                            return ` ${ctx.label}: ${ctx.parsed} Berkas`;
                        }
                    }
                }
            },
            animation: { duration: 800 }
        };

        new Chart(canvas, { 
            type: 'doughnut', 
            data, 
            options: opts,
            plugins: [centerTextPlugin]
        });
    })();
</script>
@endsection