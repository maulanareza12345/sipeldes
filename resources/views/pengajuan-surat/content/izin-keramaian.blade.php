@php
    $df = $pengajuan->data_fields ?? [];
    $keterangan = $pengajuan->keterangan ?? '';
    $jenisAcara = $df['jenis_acara'] ?? '-';
    $tglAcara = $df['tanggal_acara'] ?? '';
    $waktuAcara = $df['waktu_acara'] ?? '-';
    $lokasiAcara = $df['lokasi_acara'] ?? '-';
    $jmlPeserta = $df['jumlah_peserta'] ?? '-';
    $penanggungJawab = $df['penanggung_jawab'] ?? '-';
    $tglAcaraFormatted = $tglAcara ? date('d-m-Y', strtotime($tglAcara)) : '-';
@endphp
<div class="text-justify space-bottom">
    Kepala Desa Bojongloa Kecamatan Rancaekek Kabupaten Bandung menerangkan bahwa :
</div>

@include('pengajuan-surat.content._identitas_penduduk')

<div class="text-justify space-bottom" style="margin-top: 15px;">
    Sepanjang pengetahuan kami, orang tersebut di atas berkelakuan baik dan bermaksud mengadakan kegiatan/keramaian sebagai berikut:
</div>

<table style="margin-left: 40px; margin-bottom: 15px; border-collapse: collapse;">
    <tr><td style="width: 140px; vertical-align: top;">Jenis Acara</td><td style="width: 15px;">:</td><td><b>{{ $jenisAcara }}</b></td></tr>
    <tr><td style="vertical-align: top;">Tanggal</td><td>:</td><td>{{ $tglAcaraFormatted }}</td></tr>
    <tr><td style="vertical-align: top;">Waktu</td><td>:</td><td>{{ $waktuAcara }}</td></tr>
    <tr><td style="vertical-align: top;">Lokasi</td><td>:</td><td>{{ $lokasiAcara }}</td></tr>
    <tr><td style="vertical-align: top;">Jumlah Peserta</td><td>:</td><td>{{ $jmlPeserta }} orang</td></tr>
    <tr><td style="vertical-align: top;">Penanggung Jawab</td><td>:</td><td>{{ $penanggungJawab }}</td></tr>
</table>

@include('pengajuan-surat.content._surat_pengantar')
@include('pengajuan-surat.content._penutup')

