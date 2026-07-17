<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Laporan Bulanan</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 20mm 20mm 20mm 20mm;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            color: #000;
            line-height: 1.5;
            background: #fff;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .wrapper, .wrapper * { margin: 0; padding: 0; }
        table { border-collapse: collapse; table-layout: fixed; width: 100%; }

        /* Struktur KOP Surat (samakan dengan pdf pengajuan surat) */
        .kop-table {
            width: 100%;
            border-bottom: 4px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop-table td { vertical-align: middle; }
        .logo-cell { width: 15%; text-align: left; }
        .logo-img { width: 75px; height: auto; display: block; }

        .instansi-cell { width: 85%; text-align: center; }
        .instansi-title { font-size: 14pt; font-weight: bold; text-transform: uppercase; line-height: 1.2; }
        .kecamatan-title { font-size: 13pt; font-weight: bold; text-transform: uppercase; line-height: 1.2; }
        .desa-title { font-size: 16pt; font-weight: bold; text-transform: uppercase; line-height: 1.2; letter-spacing: 0.5px; }
        .alamat-text { font-size: 9.5pt; font-weight: normal; line-height: 1.3; margin-top: 4px; font-style: italic; }

        /* Judul Dokumen (samakan) */
        .judul-block { text-align: center; margin-bottom: 25px; }
        .judul-surat { font-size: 13pt; font-weight: bold; text-transform: uppercase; text-decoration: underline; }
        .nomor-surat { font-size: 11pt; margin-top: 2px; }

        .text-justify { text-align: justify; }
        .indentasi { text-indent: 40px; }
        .space-bottom { margin-bottom: 15px; }

        /* Tabel Ringkasan */
        .tabel-ringkasan {
            width: 100%;
            margin-top: 10px;
            border: 1px solid #000;
        }
        .tabel-ringkasan th,
        .tabel-ringkasan td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: top;
        }
        .tabel-ringkasan th {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11.5pt;
        }
        .tabel-ringkasan td {
            font-size: 11.5pt;
        }

        .text-uppercase { text-transform: uppercase; }
        .text-bold { font-weight: bold; }

        /* Blok Tanda Tangan (samakan) */
        .ttd-container {
            width: 100%;
            margin-top: 35px;
            border-collapse: collapse;
        }

        .ttd-kolom-kiri { width: 55%; }
        .ttd-kolom-kanan {
            width: 45%;
            text-align: center;
            vertical-align: top;
        }

        .ttd-jabatan {
            text-transform: uppercase;
            font-size: 12pt;
            line-height: 1.3;
        }

        .ttd-ruang-kosong { height: 65px; }

        .ttd-nama {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12pt;
            display: inline-block;
            border-bottom: 1px solid #000000;
            padding-bottom: 4px;
        }
    </style>
</head>
<body>
@php
    $desa = \App\Models\DesaSetting::query()->first();
    $tanggalTtd = now()->toDateString();

    // TTD dinamis per bulan (dari tabel laporan_ttd_bulanan), fallback ke desa_settings
    $namaPejabatTtd = $ttd?->nama_ttd ?? ($desa?->kop_nama_pejabat ?? null);
    $jabatanPejabatTtd = $ttd?->jabatan_ttd ?? ($desa?->kop_jabatan ?? null);

    $namaPejabatTtd = $namaPejabatTtd ?: 'AMINUDIN, S.Ag';
    $jabatanPejabatTtd = $jabatanPejabatTtd ?: 'U.b Kepala Desa Bojongloa';

    // Format tanggal Indonesia
    $tanggalIndo = $tanggalTtd;
    try {
        if (!empty($tanggalTtd)) {
            $dt = date_create($tanggalTtd);
            $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            $tanggalIndo = date_format($dt, 'd') . ' ' . $bulan[(int)date_format($dt,'m')-1] . ' ' . date_format($dt,'Y');
        }
    } catch (\Exception $e) {}

    $pending = max(0, ($laporan->total_pengajuan ?? 0) - ($laporan->total_disetujui ?? 0) - ($laporan->total_ditolak ?? 0));

    // Nama bulan
    $bulanLabel = $laporan->bulan;
    if (is_numeric($laporan->bulan)) {
        $bulanLabel = \Carbon\Carbon::create()->month($laporan->bulan)->translatedFormat('F');
    }
@endphp

<div class="wrapper">
    <table class="kop-table">
        <tr>
            <td class="logo-cell">
                <img src="{{ public_path('images/Logo.jpg') }}" class="logo-img" alt="Logo Daerah" />
            </td>
            <td class="instansi-cell">
                <div class="instansi-title">PEMERINTAH KABUPATEN BANDUNG</div>
                <div class="kecamatan-title">KECAMATAN RANCAEKEK</div>
                <div class="desa-title">DESA BOJONGLOA</div>
                <div class="alamat-text">
                    @if($desa?->kop_alamat)
                        Alamat : {{ $desa->kop_alamat }}
                        {{ $desa->kop_kontak ? ' Telp. ' . $desa->kop_kontak : '' }}
                        {{ $desa->kop_kode_pos ? ' Kode Pos ' . $desa->kop_kode_pos : '' }}
                    @else
                        Alamat : Jl. Raya Bandung-Garut Km 20 Rt 01 Rw 01 Desa Bojongloa Kec. Rancaekek Kab. Bandung<br>Telp. (022) 7797922 Kode Pos 40394
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <div class="judul-block">
        <div class="judul-surat">REKAPITULASI LAPORAN PELAYANAN BULAN {{ strtoupper($bulanLabel) }} TAHUN {{ $laporan->tahun }}</div>
        <div class="nomor-surat">Nomor : -</div>
    </div>

    <div class="text-justify space-bottom" style="margin-top: 10px;">
        Dengan ini kami laporkan rekapitulasi pelayanan administrasi desa untuk bulan tersebut di atas.
    </div>

    <table class="tabel-ringkasan">
        <thead>
            <tr>
                <th style="width: 35%;">Status</th>
                <th style="width: 65%;">Jumlah Berkas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-uppercase text-bold">Disetujui</td>
                <td>{{ $laporan->total_disetujui ?? 0 }}</td>
            </tr>
            <tr>
                <td class="text-uppercase text-bold">Ditolak</td>
                <td>{{ $laporan->total_ditolak ?? 0 }}</td>
            </tr>
            <tr>
                <td class="text-uppercase text-bold">Pending</td>
                <td>{{ $pending }}</td>
            </tr>
            <tr>
                <td class="text-uppercase text-bold">Total Pengajuan</td>
                <td>{{ $laporan->total_pengajuan ?? 0 }}</td>
            </tr>
        </tbody>
    </table>

    <table class="ttd-container">
        <tr>
            <td class="ttd-kolom-kiri"></td>
            <td class="ttd-kolom-kanan">
                <div style="margin-bottom: 5px;">Bojongloa, {{ $tanggalIndo }}</div>
                <div class="ttd-jabatan">{{ $jabatanPejabatTtd }}</div>
                <div class="ttd-ruang-kosong"></div>
                <div class="ttd-nama">{{ $namaPejabatTtd }}</div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>

