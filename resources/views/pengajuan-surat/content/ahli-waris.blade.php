@php
    $df = $pengajuan->data_fields ?? [];
    $keterangan = $pengajuan->keterangan ?? '';
    $namaPewaris = $df['nama_pewaris'] ?? '-';
    $nikPewaris = $df['nik_pewaris'] ?? '-';
    $tglMeninggal = $df['tanggal_meninggal'] ?? '';
    $tempatMeninggal = $df['tempat_meninggal'] ?? '-';
    $daftarAhliWaris = $df['daftar_ahli_waris'] ?? '-';
    $hartaWaris = $df['harta_waris'] ?? '';
    $keperluan = $df['keperluan'] ?? $keterangan;
    $tglMeninggalFormatted = $tglMeninggal ? date('d-m-Y', strtotime($tglMeninggal)) : '-';
@endphp
<div class="text-justify space-bottom">
    Kepala Desa Bojongloa Kecamatan Rancaekek Kabupaten Bandung menerangkan bahwa :
</div>

@include('pengajuan-surat.content._identitas_penduduk')

<div class="text-justify space-bottom" style="margin-top: 15px;">
    Bahwa orang tersebut diatas adalah ahli waris dari almarhum/almarhumah:
</div>

<table style="margin-left: 40px; margin-bottom: 15px; border-collapse: collapse;">
    <tr><td style="width: 130px; vertical-align: top;">Nama Pewaris</td><td style="width: 15px;">:</td><td><b>{{ $namaPewaris }}</b></td></tr>
    <tr><td style="vertical-align: top;">NIK Pewaris</td><td>:</td><td>{{ $nikPewaris }}</td></tr>
    <tr><td style="vertical-align: top;">Meninggal</td><td>:</td><td>{{ $tempatMeninggal }}, {{ $tglMeninggalFormatted }}</td></tr>
</table>

<div class="text-justify space-bottom">
    <b>Daftar Ahli Waris:</b><br>
    {{ $daftarAhliWaris }}
</div>

@if($hartaWaris)
<div class="text-justify space-bottom">
    <b>Harta Waris:</b><br>
    {{ $hartaWaris }}
</div>
@endif

<div class="text-justify space-bottom">
    Surat Ahli Waris ini dipergunakan untuk: <b>{{ $keperluan }}</b>
</div>

@include('pengajuan-surat.content._surat_pengantar')
@include('pengajuan-surat.content._penutup')

