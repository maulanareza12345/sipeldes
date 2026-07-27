@php
    $df = $pengajuan->data_fields ?? [];
    $keterangan = $pengajuan->keterangan ?? '';
    $alamatDomisili = $df['alamat_domisili'] ?? $pengajuan->penduduk->alamat ?? '-';
    $keperluan = $df['keperluan'] ?? $keterangan;
    $lamaTinggal = $df['lama_tinggal'] ?? '';
@endphp
<div class="text-justify space-bottom">
    Kepala Desa Bojongloa Kecamatan Rancaekek Kabupaten Bandung menerangkan bahwa :
</div>

@include('pengajuan-surat.content._identitas_penduduk')

<div class="text-justify space-bottom" style="margin-top: 15px;">
    Orang tersebut diatas berdasarkan pengantar dari Ketua RT/RW adalah benar-benar berdomisili di <b>{{ $alamatDomisili }}</b>.
    @if($lamaTinggal)
        Telah tinggal selama <b>{{ $lamaTinggal }}</b>.
    @endif
</div>

<div class="text-justify space-bottom">
    Surat Keterangan Domisili ini dipergunakan untuk: <b>{{ $keperluan }}</b>
</div>

@include('pengajuan-surat.content._surat_pengantar')
@include('pengajuan-surat.content._penutup')

