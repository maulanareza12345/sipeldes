@php $p = $pengajuan->penduduk; @endphp
<table class="tabel-identitas">
    <tr>
        <td class="kolom-label">Nama</td>
        <td class="kolom-titikdua">:</td>
        <td class="kolom-nilai text-bold text-uppercase">{{ $p->nama ?? '-' }}</td>
    </tr>
    <tr>
        <td class="kolom-label">NIK</td>
        <td class="kolom-titikdua">:</td>
        <td class="kolom-nilai">{{ $p->nik ?? '-' }}</td>
    </tr>
    <tr>
        <td class="kolom-label">Tempat /tgl Lahir</td>
        <td class="kolom-titikdua">:</td>
        <td class="kolom-nilai">
            {{ $p->tempat_lahir ?? '-' }}, {{ isset($p->tanggal_lahir) ? date('d-m-Y', strtotime($p->tanggal_lahir)) : '-' }}
        </td>
    </tr>
    <tr>
        <td class="kolom-label">Jenis Kelamin</td>
        <td class="kolom-titikdua">:</td>
        <td class="kolom-nilai">{{ $p->jenis_kelamin ?? '-' }}</td>
    </tr>
    <tr>
        <td class="kolom-label">Kewarganegaraan</td>
        <td class="kolom-titikdua">:</td>
        <td class="kolom-nilai">Indonesia</td>
    </tr>
    <tr>
        <td class="kolom-label">Agama</td>
        <td class="kolom-titikdua">:</td>
        <td class="kolom-nilai">{{ ucfirst(strtolower($p->agama ?? '-')) }}</td>
    </tr>
    <tr>
        <td class="kolom-label">Status</td>
        <td class="kolom-titikdua">:</td>
        <td class="kolom-nilai">{{ ucfirst(strtolower($p->status ?? '-')) }}</td>
    </tr>
    <tr>
        <td class="kolom-label">Pekerjaan</td>
        <td class="kolom-titikdua">:</td>
        <td class="kolom-nilai">{{ ucfirst(strtolower($p->pekerjaan ?? '-')) }}</td>
    </tr>
    <tr>
        <td class="kolom-label">Alamat</td>
        <td class="kolom-titikdua">:</td>
        <td class="kolom-nilai">{{ $p->alamat ?? '-' }}</td>
    </tr>
</table>

