@php
    $df = $pengajuan->data_fields ?? [];
    $keterangan = $pengajuan->keterangan ?? '';
    $namaBayi = $df['nama_bayi'] ?? '-';
    $tempatLahir = $df['tempat_lahir_bayi'] ?? '-';
    $tglLahir = $df['tanggal_lahir_bayi'] ?? '';
    $jenisKelamin = $df['jenis_kelamin_bayi'] ?? '-';
    $namaAyah = $df['nama_ayah'] ?? '-';
    $namaIbu = $df['nama_ibu'] ?? '-';
    $anakKe = $df['anak_ke'] ?? '1';
    $tglLahirFormatted = $tglLahir ? date('d-m-Y', strtotime($tglLahir)) : '-';
@endphp
<div class="text-justify space-bottom">
    Kepala Desa Bojongloa Kecamatan Rancaekek Kabupaten Bandung menerangkan bahwa :
</div>

@include('pengajuan-surat.content._identitas_penduduk')

<div class="text-justify space-bottom" style="margin-top: 15px;">
    Telah lahir seorang anak pada:
</div>

<table style="margin-left: 40px; margin-bottom: 15px; border-collapse: collapse;">
    <tr><td style="width: 130px; vertical-align: top;">Nama Anak</td><td style="width: 15px;">:</td><td><b>{{ $namaBayi }}</b></td></tr>
    <tr><td style="vertical-align: top;">Tempat Lahir</td><td>:</td><td>{{ $tempatLahir }}</td></tr>
    <tr><td style="vertical-align: top;">Tanggal Lahir</td><td>:</td><td>{{ $tglLahirFormatted }}</td></tr>
    <tr><td style="vertical-align: top;">Jenis Kelamin</td><td>:</td><td>{{ $jenisKelamin }}</td></tr>
    <tr><td style="vertical-align: top;">Anak Ke-</td><td>:</td><td>{{ $anakKe }}</td></tr>
</table>

<table style="margin-left: 40px; margin-bottom: 15px; border-collapse: collapse;">
    <tr><td style="width: 130px; vertical-align: top;">Nama Ayah</td><td style="width: 15px;">:</td><td><b>{{ $namaAyah }}</b></td></tr>
    <tr><td style="vertical-align: top;">Nama Ibu</td><td>:</td><td><b>{{ $namaIbu }}</b></td></tr>
</table>

@if(!empty($df['keperluan']))
<div class="text-justify space-bottom">
    Surat Keterangan Kelahiran ini dipergunakan untuk: <b>{{ $df['keperluan'] }}</b>
</div>
@endif

@include('pengajuan-surat.content._surat_pengantar')
@include('pengajuan-surat.content._penutup')

