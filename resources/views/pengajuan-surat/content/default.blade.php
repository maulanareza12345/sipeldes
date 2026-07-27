@php
    $keterangan = $pengajuan->keterangan ?? '';
@endphp
<div class="text-justify space-bottom">
    Kepala Desa Bojongloa Kecamatan Rancaekek Kabupaten Bandung menerangkan bahwa :
</div>

@include('pengajuan-surat.content._identitas_penduduk')

<div class="text-justify space-bottom" style="margin-top: 15px;">
    Surat keterangan ini dipergunakan untuk keperluan: {{ $keterangan ?: '-' }}
</div>

@include('pengajuan-surat.content._surat_pengantar')
@include('pengajuan-surat.content._penutup')

