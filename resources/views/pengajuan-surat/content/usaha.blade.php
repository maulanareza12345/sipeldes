@php
    $df = $pengajuan->data_fields ?? [];
    $keterangan = $pengajuan->keterangan ?? '';
    $namaUsaha = $df['nama_usaha'] ?? '-';
    $jenisUsaha = $df['jenis_usaha'] ?? '-';
    $alamatUsaha = $df['alamat_usaha'] ?? '-';
    $modalUsaha = $df['modal_usaha'] ?? '';
    $keperluan = $df['keperluan'] ?? $keterangan;
@endphp
<div class="text-justify space-bottom">
    Kepala Desa Bojongloa Kecamatan Rancaekek Kabupaten Bandung menerangkan bahwa :
</div>

@include('pengajuan-surat.content._identitas_penduduk')

<div class="text-justify space-bottom" style="margin-top: 15px;">
    Orang tersebut diatas berdasarkan pengantar dari Ketua RT/RW adalah benar-benar memiliki dan menjalankan bidang usaha sebagai berikut:
</div>

<table style="margin-left: 40px; margin-bottom: 15px; border-collapse: collapse;">
    <tr><td style="width: 130px; vertical-align: top;">Nama Usaha</td><td style="width: 15px;">:</td><td><b>{{ $namaUsaha }}</b></td></tr>
    <tr><td style="vertical-align: top;">Jenis Usaha</td><td>:</td><td>{{ $jenisUsaha }}</td></tr>
    <tr><td style="vertical-align: top;">Alamat Usaha</td><td>:</td><td>{{ $alamatUsaha }}</td></tr>
    @if($modalUsaha)
    <tr><td style="vertical-align: top;">Modal Usaha</td><td>:</td><td>Rp. {{ number_format((int) str_replace(['.', ','], '', $modalUsaha), 0, ',', '.') }}</td></tr>
    @endif
</table>

<div class="text-justify space-bottom">
    Surat Keterangan Usaha ini dipergunakan untuk: <b>{{ $keperluan }}</b>
</div>

@include('pengajuan-surat.content._surat_pengantar')
@include('pengajuan-surat.content._penutup')

