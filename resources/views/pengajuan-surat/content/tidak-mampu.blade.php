@php
    $df = $pengajuan->data_fields ?? [];
    $keterangan = $pengajuan->keterangan ?? '';
    $penghasilan = $df['penghasilan'] ?? '';
    $tanggungan = $df['tanggungan'] ?? '';
    $keperluan = $df['keperluan'] ?? $keterangan;
    $keteranganTambahan = $df['keterangan_tambahan'] ?? '';
@endphp
<div class="text-justify space-bottom">
    Kepala Desa Bojongloa Kecamatan Rancaekek Kabupaten Bandung menerangkan bahwa :
</div>

@include('pengajuan-surat.content._identitas_penduduk')

<div class="text-justify space-bottom" style="margin-top: 15px;">
    Orang tersebut diatas berdasarkan pengantar dari Ketua RT/RW adalah benar-benar penduduk yang kurang mampu / tidak mampu secara ekonomi dengan rincian:
</div>

<table style="margin-left: 40px; margin-bottom: 15px; border-collapse: collapse;">
    @if($penghasilan)
    <tr><td style="width: 170px; vertical-align: top;">Penghasilan per Bulan</td><td style="width: 15px;">:</td><td>Rp. {{ number_format((int) str_replace(['.', ','], '', $penghasilan), 0, ',', '.') }}</td></tr>
    @endif
    @if($tanggungan)
    <tr><td style="vertical-align: top;">Jumlah Tanggungan</td><td>:</td><td>{{ $tanggungan }} orang</td></tr>
    @endif
</table>

<div class="text-justify space-bottom">
    Surat Keterangan Tidak Mampu ini dipergunakan untuk: <b>{{ $keperluan }}</b>
</div>

@if($keteranganTambahan)
<div class="text-justify space-bottom">
    <b>Keterangan Tambahan:</b> {{ $keteranganTambahan }}
</div>
@endif

@include('pengajuan-surat.content._surat_pengantar')
@include('pengajuan-surat.content._penutup')

