@php
    $df = $pengajuan->data_fields ?? [];
    $keterangan = $pengajuan->keterangan ?? '';
    $objek = $df['objek_sengketa'] ?? '-';
    $lokasiObjek = $df['lokasi_objek'] ?? '-';
    $pernyataanTambahan = $df['pernyataan_tambahan'] ?? '';
    $keperluan = $df['keperluan'] ?? $keterangan;
@endphp
<div class="text-justify space-bottom">
    Kepala Desa Bojongloa Kecamatan Rancaekek Kabupaten Bandung menerangkan bahwa :
</div>

@include('pengajuan-surat.content._identitas_penduduk')

<div class="text-justify space-bottom" style="margin-top: 15px;">
    Bahwa berdasarkan pengantar dari Ketua RT/RW dan sepanjang pengetahuan kami, orang tersebut diatas tidak terlibat dalam sengketa atas:
</div>

<table style="margin-left: 40px; margin-bottom: 15px; border-collapse: collapse;">
    <tr><td style="width: 130px; vertical-align: top;">Objek</td><td style="width: 15px;">:</td><td><b>{{ $objek }}</b></td></tr>
    <tr><td style="vertical-align: top;">Lokasi</td><td>:</td><td>{{ $lokasiObjek }}</td></tr>
</table>

@if($pernyataanTambahan)
<div class="text-justify space-bottom">
    <b>Pernyataan Tambahan:</b> {{ $pernyataanTambahan }}
</div>
@endif

<div class="text-justify space-bottom">
    Surat Bebas Sengketa ini dipergunakan untuk: <b>{{ $keperluan }}</b>
</div>

@include('pengajuan-surat.content._surat_pengantar')
@include('pengajuan-surat.content._penutup')

