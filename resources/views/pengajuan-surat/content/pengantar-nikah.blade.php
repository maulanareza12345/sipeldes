@php
    $df = $pengajuan->data_fields ?? [];
    $keterangan = $pengajuan->keterangan ?? '';
    $calonSuami = $df['nama_calon_suami'] ?? '-';
    $nikCalonSuami = $df['nik_calon_suami'] ?? '-';
    $calonIstri = $df['nama_calon_istri'] ?? '-';
    $nikCalonIstri = $df['nik_calon_istri'] ?? '-';
    $tglNikah = $df['tanggal_nikah'] ?? '';
    $masKawin = $df['mas_kawin'] ?? '';
    $tglNikahFormatted = $tglNikah ? date('d-m-Y', strtotime($tglNikah)) : '-';
@endphp
<div class="text-justify space-bottom">
    Kepala Desa Bojongloa Kecamatan Rancaekek Kabupaten Bandung menerangkan bahwa :
</div>

@include('pengajuan-surat.content._identitas_penduduk')

<div class="text-justify space-bottom" style="margin-top: 15px;">
    Orang tersebut diatas berdasarkan pengantar dari Ketua RT/RW akan melangsungkan pernikahan dengan:
</div>

<table style="margin-left: 40px; margin-bottom: 15px; border-collapse: collapse;">
    <tr><td style="width: 140px; vertical-align: top; font-weight: bold;" colspan="3">IDENTITAS CALON SUAMI</td></tr>
    <tr><td style="width: 130px; vertical-align: top;">Nama</td><td style="width: 15px;">:</td><td><b>{{ $calonSuami }}</b></td></tr>
    <tr><td style="vertical-align: top;">NIK</td><td>:</td><td>{{ $nikCalonSuami }}</td></tr>
    <tr style="height: 10px;"><td colspan="3"></td></tr>
    <tr><td style="width: 140px; vertical-align: top; font-weight: bold;" colspan="3">IDENTITAS CALON ISTRI</td></tr>
    <tr><td style="vertical-align: top;">Nama</td><td>:</td><td><b>{{ $calonIstri }}</b></td></tr>
    <tr><td style="vertical-align: top;">NIK</td><td>:</td><td>{{ $nikCalonIstri }}</td></tr>
</table>

@if($tglNikah)
<div class="text-justify space-bottom">
    Rencana pernikahan akan dilaksanakan pada tanggal <b>{{ $tglNikahFormatted }}</b>
    @if($masKawin) dengan mas kawin: {{ $masKawin }} @endif
</div>
@endif

@if(!empty($df['keperluan']))
<div class="text-justify space-bottom">
    Surat Pengantar Nikah ini dipergunakan untuk: <b>{{ $df['keperluan'] }}</b>
</div>
@endif

@include('pengajuan-surat.content._surat_pengantar')
@include('pengajuan-surat.content._penutup')

