@extends('layouts.app')

@section('title', 'Pengaturan TTD Bulanan - Sistem Desa')

@section('content')
<style>
    .page-wrap { max-width: 1050px; margin: 0 auto; }
    .section-title { font-size: 1.2rem; font-weight: 800; color: #0f172a; margin-bottom: 12px; }
    .card { background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px; }
    .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .grid-2 { grid-template-columns: 1.2fr 1fr; }
    label { font-size: 0.9rem; color: #334155; font-weight: 600; }
    input, select { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 10px; }
    .btn { padding: 10px 16px; border-radius: 10px; font-weight: 700; border: 0; cursor: pointer; }
    .btn-primary { background: #2563eb; color: #fff; }
    .btn-primary:hover { background: #1d4ed8; }
    .btn-danger { background: #dc2626; color: #fff; }
    .btn-danger:hover { background: #b91c1c; }
    .alert { padding: 12px 16px; border-radius: 12px; margin-bottom: 16px; }
    .alert-success { background: #ecfdf3; color: #065f46; border: 1px solid #a7f3d0; }
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border-bottom: 1px solid #f1f5f9; padding: 12px 10px; text-align: left; }
    th { font-size: 0.85rem; color: #475569; background: #f8fafc; border-bottom: 1px solid #e2e8f0; }
</style>

<div class="page-wrap">
    <div style="margin-bottom: 18px;">
        <div class="section-title">Pengaturan TTD Bulanan (Rekap Laporan PDF)</div>
        <div style="color:#64748b; font-size:0.95rem;">Admin dapat mengisi Nama dan Jabatan penanda tangan yang berbeda untuk setiap bulan laporan.</div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card" style="margin-bottom: 18px;">
        <form method="POST" action="{{ route('laporan.ttd-bulanan.update') }}">
            @csrf
            <div class="grid grid-2">
                <div>
                    <label>Bulan</label>
                    <select name="bulan" required>
                        @for($m=1;$m<=12;$m++)
                            <option value="{{ $m }}" {{ (int)request()->input('bulan', $bulan) === $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label>Tahun</label>
                    <input type="number" name="tahun" value="{{ request()->input('tahun', $tahun) }}" min="1900" max="2100" required>
                </div>
            </div>

            <div class="grid" style="margin-top:14px;">
                <div>
                    <label>Nama Penanda Tangan</label>
                    <input type="text" name="nama_ttd" value="{{ old('nama_ttd', $current->nama_ttd ?? '') }}" placeholder="Contoh: AMINUDIN, S.Ag" required>
                </div>

                <div>
                    <label>Jabatan Penanda Tangan</label>
                    <input type="text" name="jabatan_ttd" value="{{ old('jabatan_ttd', $current->jabatan_ttd ?? '') }}" placeholder="Contoh: U.b Kepala Desa Bojongloa" required>
                </div>
            </div>

            <div style="margin-top:16px; display:flex; gap:10px; align-items:center;">
                <button type="submit" class="btn btn-primary">Simpan / Update</button>
                <div style="color:#64748b; font-size:0.9rem;">Jika data untuk (bulan,tahun) sudah ada, akan di-update.</div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="section-title" style="margin-bottom: 10px;">Daftar TTD Bulanan</div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width: 120px;">Bulan</th>
                        <th style="width: 90px;">Tahun</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rows as $r)
                        <tr>
                            <td>{{ \Carbon\Carbon::create()->month($r->bulan)->translatedFormat('F') }}</td>
                            <td>{{ $r->tahun }}</td>
                            <td>{{ $r->nama_ttd }}</td>
                            <td>{{ $r->jabatan_ttd }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="color:#94a3b8; text-align:center; padding:30px 10px;">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 16px;">
            {{ $rows->links() }}
        </div>
    </div>
</div>
@endsection

