<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan</title>
    <style>
        /* Pengaturan Halaman A4 Dinas */
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

        /* Reset standar untuk DomPDF */
        .wrapper, .wrapper * { margin: 0; padding: 0; }
        table { border-collapse: collapse; table-layout: fixed; width: 100%; }

        /* Struktur KOP Surat */
        .kop-table { 
            width: 100%; 
            border-bottom: 4px double #000; /* Garis ganda tebal-tipis dinas */
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

        /* Judul Dokumen */
        .judul-block { text-align: center; margin-bottom: 25px; }
        .judul-surat { font-size: 13pt; font-weight: bold; text-transform: uppercase; text-decoration: underline; }
        .nomor-surat { font-size: 11pt; margin-top: 2px; }

        /* Konten Paragraf */
        .text-justify { text-align: justify; }
        .indentasi { text-indent: 40px; }
        .space-bottom { margin-bottom: 15px; }

       /* Tabel Data Identitas Rata & Rapi - Jarak Kolom Dipersempit */
.tabel-identitas { 
    margin-left: 40px; 
    margin-top: 15px; 
    margin-bottom: 25px; 
    width: auto; /* Diubah dari 90% ke auto agar lebar tabel mengikuti isi kolom */
    border-collapse: collapse; 
}

.tabel-identitas td { 
    vertical-align: top; 
    padding: 6px 0; /* Mengatur jarak renggang vertikal antar baris */
    line-height: 1.3;
}

/* PERBAIKAN UTAMA: Lebar kolom label dipersempit dari 160px menjadi 125px */
.tabel-identitas .kolom-label { 
    width: 125px; 
}

/* Kolom titik dua dibuat seminimal mungkin dan rata kiri */
.tabel-identitas .kolom-titikdua { 
    width: 15px; 
    text-align: left; 
}

/* Kolom nilai menempel langsung dengan jarak 1 spasi tipis (5px) */
.tabel-identitas .kolom-nilai { 
    width: auto;
    padding-left: 5px; 
}
        
.text-uppercase { text-transform: uppercase; }
.text-bold { font-weight: bold; }

        /* Blok Tanda Tangan (TTD) */
        /* Blok Tanda Tangan (TTD) - Perbaikan Garis Bawah */
.ttd-container { 
    width: 100%; 
    margin-top: 35px; 
    border-collapse: collapse;
}

.ttd-kolom-kiri { 
    width: 55%; 
}

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

.ttd-ruang-kosong {
    height: 65px; /* Jarak ruang kosong untuk tanda tangan basah */
}

/* PERBAIKAN GARIS: Menggunakan border-bottom dan padding agar garis bisa turun ke bawah */
.ttd-nama { 
    font-weight: bold; 
    text-transform: uppercase; 
    font-size: 12pt; 
    display: inline-block; 
    border-bottom: 1px solid #000000; /* Membuat garis sendiri sebagai pengganti underline */
    padding-bottom: 4px; /* Mengatur seberapa jauh garis turun ke bawah dari teks nama */
}
    </style>
</head>
<body>
@php
    $desa = \App\Models\DesaSetting::query()->first();
    $tanggalTtd = $pengajuan->tanggal_disetujui ?: now()->toDateString();
    $p = $pengajuan->penduduk;
    
    // Pemetaan Judul Surat Dinamis
    $namaJenis = $pengajuan->jenisSurat->nama ?? '';
    $judul = match (strtolower(trim($namaJenis))) {
        'surat keterangan domisili' => 'SURAT KETERANGAN DOMISILI',
        'surat pengantar ktp' => 'SURAT PENGANTAR KTP',
        'surat pengantar kk' => 'SURAT PENGANTAR KK',
        'surat keterangan usaha' => 'SURAT KETERANGAN USAHA',
        'surat keterangan tidak mampu' => 'SURAT KETERANGAN TIDAK MAMPU',
        'surat keterangan kelahiran' => 'SURAT KETERANGAN KELAHIRAN',
        'surat keterangan kematian' => 'SURAT KETERANGAN KEMATIAN',
        'surat pindah' => 'SURAT PINDAH',
        'surat kehilangan' => 'SURAT KEHILANGAN',
        'surat izin keramaian' => 'SURAT IZIN KERAMAIAN',
        'surat pengantar nikah' => 'SURAT PENGANTAR NIKAH',
        'surat ahli waris' => 'SURAT AHLI WARIS',
        'surat bebas sengketa' => 'SURAT BEBAS SENGKETA',
        default => strtoupper($namaJenis ?: 'SURAT KETERANGAN'),
    };

    $jenisKey = strtolower(trim($namaJenis));
    $keterangan = $pengajuan->keterangan ?? '';

    // Logika Pemetaan Teks Paragraf Inti Sesuai Jenis Layanan
    $paragrafTujuan = match($jenisKey) {
        'surat keterangan domisili', 'surat domisili' => 'Orang tersebut diatas berdasarkan Pengantar dari Ketua RT/RW adalah benar-benar Berdomisili di ' . ($p->alamat ?? 'Desa Bojongloa') . '.<br><br>Surat Keterangan Domisili ini dipergunakan untuk Persyaratan: ' . ($keterangan ?: 'Administrasi Kependudukan.'),
        // untuk pengantar KK/NIK, isi domisili harus tetap mengacu pada alamat penduduk (otomatis dari pengajuan/pilih penduduk)
        'surat pengantar kk' => 'Orang tersebut diatas berdasarkan Pengantar dari Ketua RT/RW adalah benar-benar Berdomisili di ' . ($p->alamat ?? 'Desa Bojongloa') . '.<br><br>Surat Pengantar KK ini dipergunakan untuk Persyaratan: ' . ($keterangan ?: '-'),
        'surat pengantar nik' => 'Orang tersebut diatas berdasarkan Pengantar dari Ketua RT/RW adalah benar-benar Berdomisili di ' . ($p->alamat ?? 'Desa Bojongloa') . '.<br><br>Surat Pengantar NIK ini dipergunakan untuk Persyaratan: ' . ($keterangan ?: '-'),
        'surat pengantar ktp' => 'Orang tersebut diatas berdasarkan Pengantar dari Ketua RT/RW adalah benar-benar Berdomisili di ' . ($p->alamat ?? 'Desa Bojongloa') . '.<br><br>Surat Pengantar KTP ini dipergunakan untuk Persyaratan: ' . ($keterangan ?: '-'),

        'surat izin keramaian' => 'Menerangkan bahwa sepanjang pengetahuan kami orang tersebut di atas berkelakuan baik dan bermaksud mengadakan acara/kegiatan keramaian ' . ($keterangan ?: '-') . '.',
        'surat keterangan usaha' => 'Menerangkan bahwa orang tersebut di atas benar memiliki bidang usaha ' . ($keterangan ?: '-') . ' yang berlokasi di wilayah Desa Bojongloa.',
        default => 'Surat keterangan ini dipergunakan untuk keperluan: ' . ($keterangan ?: '-'),
    };

    $paragrafPenutup = 'Demikian surat keterangan ini kami buat dengan sebenar-benarnya, dan untuk dipergunakan sebagaimana mestinya.';

    // Format Tanggal Indonesia (Contoh: 13 Juli 2026)
    $tanggalIndo = $tanggalTtd;
    try {
        if (!empty($tanggalTtd)) {
            $dt = date_create($tanggalTtd);
            $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            $tanggalIndo = date_format($dt, 'd') . ' ' . $bulan[(int)date_format($dt,'m')-1] . ' ' . date_format($dt,'Y');
        }
    } catch (\Exception $e) {}

    // Ambil nama & jabatan tanda tangan dari desa_settings (kolom opsional)
    // ambil nama & jabatan tanda tangan dari desa_settings (kolom mungkin belum ada di skema awal)
    $namaPejabatTtd = $desa?->kop_nama_pejabat ?? null;
    $jabatanPejabatTtd = $desa?->kop_jabatan ?? null;

    // jika input pengajuan-surat tidak kosong, pakai dari pengajuan; selain itu pakai dari desa_settings; terakhir fallback default.
    $namaPejabatTtd = $pengajuan?->nama_ttd ?: $namaPejabatTtd;
    $jabatanPejabatTtd = $pengajuan?->jabatan_ttd ?: $jabatanPejabatTtd;

    $namaPejabatTtd = $namaPejabatTtd ?: 'AMINUDIN, S.Ag';
    $jabatanPejabatTtd = $jabatanPejabatTtd ?: 'U.b Kepala Desa Bojongloa';
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
        <div class="judul-surat">{{ $judul }}</div>
        <div class="nomor-surat">Nomor : {{ $pengajuan->nomor_surat ?? '-' }}</div>
    </div>

    <div class="text-justify space-bottom">
        Kepala Desa Bojongloa Kecamatan Rancaekek Kabupaten Bandung menerangkan bahwa :
    </div>

    <table class="tabel-identitas">
        <tr>
            <td class="kolom-label">Nama</td>
            <td class="kolom-titikdua">:</td>
            <td class="kolom-nilai text-bold text-uppercase">{{ $p->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td class="kolom-label">NIK</td>
            <td class="kolom-titikdua">:</td>
            <td class="kolom-nilai">{{ $p->nik ?? '-' }}</td>
        </tr>


        <tr>
            <td class="kolom-label">Tempat /tgl Lahir</td>


            <td class="kolom-titikdua">:</td>
            <td class="kolom-nilai">
                {{ $p->tempat_lahir ?? '-' }}, {{ isset($p->tanggal_lahir) ? date('d-m-Y', strtotime($p->tanggal_lahir)) : '-' }}
            </td>
        </tr>

        <tr>

            <td class="kolom-label">Jenis Kelamin</td>
            <td class="kolom-titikdua">:</td>
            <td class="kolom-nilai">{{ $p->jenis_kelamin ?? '-' }}</td>
        </tr>
        <tr>
            <td class="kolom-label">Kewarganegaraan</td>
            <td class="kolom-titikdua">:</td>
            <td class="kolom-nilai">Indonesia</td>
        </tr>
        <tr>
            <td class="kolom-label">Agama</td>
            <td class="kolom-titikdua">:</td>
            <td class="kolom-nilai">{{ ucfirst(strtolower($p->agama ?? '-')) }}</td>
        </tr>
        <tr>
            <td class="kolom-label">Status</td>
            <td class="kolom-titikdua">:</td>
            <td class="kolom-nilai">{{ ucfirst(strtolower($p->status ?? '-')) }}</td>
        </tr>
        <tr>
            <td class="kolom-label">Pekerjaan</td>
            <td class="kolom-titikdua">:</td>
            <td class="kolom-nilai">{{ ucfirst(strtolower($p->pekerjaan ?? '-')) }}</td>
        </tr>
        <tr>
            <td class="kolom-label">Alamat</td>
            <td class="kolom-titikdua">:</td>
            <td class="kolom-nilai">{{ $p->alamat ?? '-' }}</td>
        </tr>
    </table>

    <div class="text-justify space-bottom" style="margin-top: 15px;">
        {!! $paragrafTujuan !!}
    </div>

    <div class="text-justify indentasi" style="margin-top: 10px;">
        <b>Surat Pengantar dari RT/RW:</b><br>
        {{ $pengajuan->surat_pengantar_rt_rw ?? '-' }}
    </div>



    <div class="text-justify indentasi space-bottom" style="margin-top: 15px;">
        {{ $paragrafPenutup }}
    </div>

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

