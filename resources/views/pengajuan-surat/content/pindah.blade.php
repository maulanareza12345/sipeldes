@php
    $df = $pengajuan->data_fields ?? [];
    $keterangan = $pengajuan->keterangan ?? '';
    
    // Data Penduduk Utama (Pemohon/Kepala Keluarga)
    $pemohon = $pengajuan->penduduk;
    $noKk = $pemohon->no_kk ?? ($df['no_kk'] ?? '-');
    $nik = $pemohon->nik ?? ($df['nik'] ?? '-');
    $nama = $pemohon->nama ?? ($df['nama'] ?? '-');
    $jenisKelamin = $pemohon->jenis_kelamin ?? ($df['jenis_kelamin'] ?? '-');
    $ttl = ($pemohon->tempat_lahir ?? ($df['tempat_lahir'] ?? '-')) . ', ' . (isset($pemohon->tanggal_lahir) ? \Carbon\Carbon::parse($pemohon->tanggal_lahir)->format('d-m-Y') : (isset($df['tanggal_lahir']) ? \Carbon\Carbon::parse($df['tanggal_lahir'])->format('d-m-Y') : '-'));
    $kewarganegaraan = $pemohon->kewarganegaraan ?? ($df['kewarganegaraan'] ?? 'Indonesia');
    $agama = $pemohon->agama ?? ($df['agama'] ?? '-');
    $pekerjaan = $pemohon->pekerjaan ?? ($df['pekerjaan'] ?? '-');
    $statusKawin = $pemohon->status_perkawinan ?? $pemohon->status ?? ($df['status_perkawinan'] ?? '-');
    $alamatAsal = $pemohon->alamat ?? ($df['alamat_asal'] ?? '-');

    // Data Daerah Tujuan
    $alamatTujuan = $df['alamat_tujuan'] ?? '-';
    $rtRwTujuan = ($df['rt_tujuan'] ?? '000') . ' / ' . ($df['rw_tujuan'] ?? '000');
    $desaTujuan = $df['desa_tujuan'] ?? ($df['kelurahan_tujuan'] ?? '-');
    $kecTujuan = $df['kecamatan_tujuan'] ?? '-';
    $kabTujuan = $df['kabupaten_tujuan'] ?? '-';
    $provTujuan = $df['provinsi_tujuan'] ?? '-';
    $tglPindah = isset($df['tanggal_pindah']) ? \Carbon\Carbon::parse($df['tanggal_pindah'])->format('d-m-Y') : date('d-m-Y');
    $alasanPindah = $df['alasan_pindah'] ?? 'Lainnya';

    // Data Anggota Keluarga yang Pindah (bisa string atau array)
    $keluargaPindah = $df['keluarga_pindah'] ?? [];
    if (is_string($keluargaPindah)) {
        $parsed = json_decode($keluargaPindah, true);
        if (is_array($parsed)) {
            $keluargaPindah = $parsed;
        } else {
            $lines = array_filter(array_map('trim', explode("\n", str_replace("\r\n", "\n", $keluargaPindah))));
            $keluargaPindah = [];
            foreach ($lines as $line) {
                $parts = explode('|', $line);
                $keluargaPindah[] = [
                    'nik' => trim($parts[0] ?? ''),
                    'nama' => trim($parts[1] ?? $line),
                    'tgl_lahir' => trim($parts[2] ?? '-'),
                    'shdk' => trim($parts[3] ?? '-'),
                ];
            }
        }
    }
@endphp

<style>
.pindah-content { font-size: 10.5pt; line-height: 1.35; }
.pindah-content .tabel-identitas { margin-left: 30px; margin-top: 5px; margin-bottom: 8px; border-collapse: collapse; }
.pindah-content .tabel-identitas td { vertical-align: top; padding: 2px 0; line-height: 1.3; }
.pindah-content .tabel-identitas .kolom-label { width: 115px; }
.pindah-content .tabel-identitas .kolom-titikdua { width: 12px; text-align: left; }
.pindah-content .tabel-identitas .kolom-nilai { width: auto; padding-left: 3px; }
.pindah-content .tabel-keluarga { width: 100%; border-collapse: collapse; font-size: 9.5pt; margin-bottom: 6px; }
.pindah-content .tabel-keluarga th { padding: 3px 4px; text-align: center; border: 1px solid #000; }
.pindah-content .tabel-keluarga td { padding: 2px 4px; border: 1px solid #000; }
.pindah-content .text-bold { font-weight: bold; }
.pindah-content .text-uppercase { text-transform: uppercase; }
</style>

<div class="pindah-content">
<div class="text-justify" style="margin-bottom: 5px;">
    Pemerintah Desa Bojongloa Kecamatan Rancaekek Kabupaten Bandung dengan ini menerangkan bahwa :
</div>

<!-- Data Identitas Pemohon -->
<table class="tabel-identitas">
    <tr><td class="kolom-label">No KK</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $noKk }}</td></tr>
    <tr><td class="kolom-label">NIK</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $nik }}</td></tr>
    <tr><td class="kolom-label">Nama</td><td class="kolom-titikdua">:</td><td class="kolom-nilai text-bold text-uppercase">{{ strtoupper($nama) }}</td></tr>
    <tr><td class="kolom-label">Jenis Kelamin</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $jenisKelamin }}</td></tr>
    <tr><td class="kolom-label">Tempat/tgl lahir</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $ttl }}</td></tr>
    <tr><td class="kolom-label">Kewarganegaraan</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $kewarganegaraan }}</td></tr>
    <tr><td class="kolom-label">Agama</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $agama }}</td></tr>
    <tr><td class="kolom-label">Pekerjaan</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $pekerjaan }}</td></tr>
    <tr><td class="kolom-label">Status</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $statusKawin }}</td></tr>
    <tr><td class="kolom-label">Alamat</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $alamatAsal }}<br>Desa Bojongloa Kec. Rancaekek Kab. Bandung.</td></tr>
</table>

<div class="text-justify" style="margin-bottom: 4px;">
    Orang tersebut diatas benar-benar akan pindah dengan data daerah tujuan sebagai berikut:
</div>

<!-- Data Daerah Tujuan -->
<table class="tabel-identitas">
    <tr><td class="kolom-label" style="vertical-align:top;">Alamat Tujuan</td><td class="kolom-titikdua" style="vertical-align:top;">:</td><td class="kolom-nilai">{{ $alamatTujuan }}</td></tr>
    <tr><td class="kolom-label">RT / RW</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $rtRwTujuan }}</td></tr>
    <tr><td class="kolom-label">Desa / Kelurahan</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $desaTujuan }}</td></tr>
    <tr><td class="kolom-label">Kecamatan</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $kecTujuan }}</td></tr>
    <tr><td class="kolom-label">Kabupaten / Kota</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $kabTujuan }}</td></tr>
    <tr><td class="kolom-label">Provinsi</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $provTujuan }}</td></tr>
    <tr><td class="kolom-label">Tanggal Pindah</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $tglPindah }}</td></tr>
    <tr><td class="kolom-label">Alasan Pindah</td><td class="kolom-titikdua">:</td><td class="kolom-nilai">{{ $alasanPindah }}</td></tr>
</table>

<!-- Tabel Anggota Keluarga yang Pindah -->
<div style="margin-bottom: 3px;"><strong>Keluarga yang pindah :</strong></div>
<table class="tabel-keluarga">
    <thead>
        <tr>
            <th style="width:22px;">No</th>
            <th>NIK</th>
            <th>NAMA</th>
            <th style="width:85px;">TGL LAHIR</th>
            <th style="width:100px;">SHDK</th>
        </tr>
    </thead>
    <tbody>
        @forelse($keluargaPindah as $index => $k)
            <tr>
                <td style="text-align:center;">{{ $index + 1 }}</td>
                <td>{{ $k['nik'] ?? '-' }}</td>
                <td style="text-transform:uppercase;">{{ strtoupper($k['nama'] ?? '-') }}</td>
                <td style="text-align:center;">{{ $k['tgl_lahir'] ?? $k['tanggal_lahir'] ?? '-' }}</td>
                <td>{{ $k['shdk'] ?? $k['hubungan'] ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td style="text-align:center;">1</td>
                <td>{{ $nik }}</td>
                <td style="text-transform:uppercase;">{{ strtoupper($nama) }}</td>
                <td style="text-align:center;">{{ isset($pemohon->tanggal_lahir) ? \Carbon\Carbon::parse($pemohon->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                <td>Kepala Keluarga</td>
            </tr>
        @endforelse
    </tbody>
</table>

@include('pengajuan-surat.content._surat_pengantar')
@include('pengajuan-surat.content._penutup')
</div>

