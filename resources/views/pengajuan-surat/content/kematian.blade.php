@php
    $df = $pengajuan->data_fields ?? [];
    $keterangan = $pengajuan->keterangan ?? '';
    $tglKematian = $df['tanggal_kematian'] ?? '';
    $tempatKematian = $df['tempat_kematian'] ?? '-';
    $penyebab = $df['penyebab_kematian'] ?? '-';
    $namaAhliWaris = $df['nama_ahli_waris'] ?? '';
    $tglKematianFormatted = $tglKematian ? date('d-m-Y', strtotime($tglKematian)) : '-';
@endphp
<div class="text-justify space-bottom">
    Kepala Desa Bojongloa Kecamatan Rancaekek Kabupaten Bandung menerangkan bahwa :
</div>

@include('pengajuan-surat.content._identitas_penduduk')

<div class="text-justify space-bottom" style="margin-top: 15px;">
    Bahwa orang tersebut diatas telah meninggal dunia pada:
</div>

<table style="margin-left: 40px; margin-bottom: 15px; border-collapse: collapse;">
    <tr><td style="width: 130px; vertical-align: top;">Tanggal</td><td style="width: 15px;">:</td><td>{{ $tglKematianFormatted }}</td></tr>
    <tr><td style="vertical-align: top;">Tempat</td><td>:</td><td>{{ $tempatKematian }}</td></tr>
    <tr><td style="vertical-align: top;">Penyebab</td><td>:</td><td>{{ $penyebab }}</td></tr>
</table>

@if($namaAhliWaris)
<div class="text-justify space-bottom">
    Ahli waris yang ditinggalkan: <b>{{ $namaAhliWaris }}</b>
</div>
@endif

@if(!empty($df['keperluan']))
<div class="text-justify space-bottom">
    Surat Keterangan Kematian ini dipergunakan untuk: <b>{{ $df['keperluan'] }}</b>
</div>
@endif

@include('pengajuan-surat.content._surat_pengantar')
@include('pengajuan-surat.content._penutup')

