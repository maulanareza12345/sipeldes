@php
    $df = $pengajuan->data_fields ?? [];
    $keterangan = $pengajuan->keterangan ?? '';
    $jenisBarang = $df['jenis_barang'] ?? '-';
    $ciriBarang = $df['ciri_barang'] ?? '-';
    $tglKehilangan = $df['tanggal_kehilangan'] ?? '';
    $lokasiKehilangan = $df['lokasi_kehilangan'] ?? '-';
    $nilaiBarang = $df['nilai_barang'] ?? '';
    $keperluan = $df['keperluan'] ?? $keterangan;
    $tglHilangFormatted = $tglKehilangan ? date('d-m-Y', strtotime($tglKehilangan)) : '-';
@endphp
<div class="text-justify space-bottom">
    Kepala Desa Bojongloa Kecamatan Rancaekek Kabupaten Bandung menerangkan bahwa :
</div>

@include('pengajuan-surat.content._identitas_penduduk')

<div class="text-justify space-bottom" style="margin-top: 15px;">
    Orang tersebut diatas telah kehilangan barang dengan rincian sebagai berikut:
</div>

<table style="margin-left: 40px; margin-bottom: 15px; border-collapse: collapse;">
    <tr><td style="width: 130px; vertical-align: top;">Jenis Barang</td><td style="width: 15px;">:</td><td><b>{{ $jenisBarang }}</b></td></tr>
    <tr><td style="vertical-align: top;">Ciri-ciri</td><td>:</td><td>{{ $ciriBarang }}</td></tr>
    <tr><td style="vertical-align: top;">Tanggal</td><td>:</td><td>{{ $tglHilangFormatted }}</td></tr>
    <tr><td style="vertical-align: top;">Lokasi</td><td>:</td><td>{{ $lokasiKehilangan }}</td></tr>
    @if($nilaiBarang)
    <tr><td style="vertical-align: top;">Nilai Barang</td><td>:</td><td>Rp. {{ number_format((int) str_replace(['.', ','], '', $nilaiBarang), 0, ',', '.') }}</td></tr>
    @endif
</table>

<div class="text-justify space-bottom">
    Surat Kehilangan ini dipergunakan untuk: <b>{{ $keperluan }}</b>
</div>

@include('pengajuan-surat.content._surat_pengantar')
@include('pengajuan-surat.content._penutup')

