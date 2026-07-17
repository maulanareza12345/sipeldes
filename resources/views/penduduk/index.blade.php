@extends('layouts.app')

@section('title', 'Data Penduduk - Sistem Desa')

@section('content')
<!-- Google Font Premium -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* COMPACT CONTROLLER */
    .dashboard-compact {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #0f172a;
        background-color: #f8fafc;
        font-size: 14px;
    }

    /* MINI HERO BANNER */
    .mini-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-radius: 16px;
        padding: 20px 24px;
        color: #ffffff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .mini-hero h1 {
        font-size: 1.35rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin: 4px 0;
        color: #ffffff;
    }
    .mini-hero p {
        color: #94a3b8;
        font-size: 0.85rem;
        margin: 0;
    }
    .mini-badge-title {
        color: #60a5fa;
        font-weight: 800;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* PREMIUM CONTENT BOX */
    .compact-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.01);
    }
    .box-title {
        margin-top: 0; 
        margin-bottom: 16px; 
        font-size: 1.05rem; 
        color: #0f172a; 
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* HIGH-DENSITY FORM GRID */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px 16px;
    }
    @media (max-width: 768px) {
        .form-grid { grid-template-columns: 1fr; }
    }
    .form-group {
        margin-bottom: 2px;
    }
    .form-group.full-width {
        grid-column: span 2;
    }
    @media (max-width: 768px) {
        .form-group.full-width { grid-column: span 1; }
    }

    /* SNEAKY INPUTS & LABELS */
    label {
        display: block;
        font-weight: 700;
        font-size: 0.78rem;
        margin-bottom: 6px;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    input[type="text"], input[type="date"], select, textarea {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 0.85rem;
        background-color: #f8fafc;
        color: #0f172a;
        transition: all 0.2s ease;
    }
    input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: #0f172a;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
    }
    input[type="file"] {
        width: 100%;
        padding: 6px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px dashed #cbd5e1;
        font-size: 0.8rem;
    }

    /* COMPACT TABLE STYLING */
    .table-responsive-box {
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        overflow: hidden;
        margin-top: 14px;
    }
    .compact-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .compact-table th {
        background: #f8fafc;
        padding: 10px 14px;
        font-weight: 700;
        color: #475569;
        font-size: 0.75rem;
        text-transform: uppercase;
        border-bottom: 1px solid #f1f5f9;
    }
    .compact-table td {
        padding: 10px 14px;
        font-size: 0.85rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        transition: background 0.15s ease;
    }
    .compact-table tbody tr:hover td {
        background-color: #f8fafc;
    }
    .compact-table tr:last-child td { border-bottom: none; }

    /* ACTION BUTTONS (HIGH LEVEL FINISH) */
    .btn-premium {
        background: #0f172a;
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }
    .btn-premium:hover {
        background: #334155;
        box-shadow: 0 4px 10px rgba(15, 23, 42, 0.15);
    }
    
    .btn-action-mini {
        padding: 4px 10px;
        font-size: 0.75rem;
        border-radius: 6px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: all 0.15s ease;
    }
    .btn-edit-mini { 
        background: #eff6ff; 
        color: #2563eb; 
        border: 1px solid #bfdbfe; 
    }
    .btn-edit-mini:hover { 
        background: #dbeafe; 
    }
    .btn-delete-mini { 
        background: #fef2f2; 
        color: #ef4444; 
        border: 1px solid #fee2e2; 
    }
    .btn-delete-mini:hover { 
        background: #fee2e2; 
    }

    /* COMPACT AVATARS */
    .avatar-mini {
        width: 32px; 
        height: 32px; 
        object-fit: cover; 
        border-radius: 50%; 
        border: 1.5px solid #e2e8f0;
    }
    .avatar-placeholder-mini {
        width: 32px; 
        height: 32px; 
        border-radius: 50%; 
        background: #f1f5f9; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        color: #94a3b8;
        font-size: 0.65rem;
        font-weight: 700;
        border: 1.5px dashed #cbd5e1;
    }

    /* ALERT STYLING */
    .alert-compact {
        padding: 10px 14px;
        border-radius: 10px;
        margin-bottom: 16px;
        font-size: 0.85rem;
        font-weight: 600;
        border: 1px solid #a7f3d0;
        background: #ecfdf3; 
        color: #065f46;
    }
</style>

<div class="dashboard-compact">
    <!-- Mini Hero Banner -->
    <div class="mini-hero">
        <div>
            <span class="mini-badge-title">Manajemen Data</span>
            <h1>Kelola Data Penduduk</h1>
            <p>Tambah, perbarui, dan tinjau berkas kartu identitas penduduk desa.</p>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert-compact">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Form Container -->
    <div class="compact-box">
        <h3 class="box-title">
            <svg style="width:16px; height:16px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            {{ isset($penduduk->id) ? 'Perbarui Informasi Penduduk' : 'Registrasi Penduduk Baru' }}
        </h3>
        
        <form method="POST" action="{{ isset($penduduk->id) ? route('penduduk.update', $penduduk) : route('penduduk.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($penduduk->id)) @method('PUT') @endif
            
            <div class="form-grid">
                <div class="form-group">
                    <label>Foto Profil</label>
                    <input type="file" name="foto">
                </div>
                <div class="form-group">
                    <label>Nomor Induk Kependudukan (NIK)</label>
                    <input type="text" name="nik" value="{{ old('nik', $penduduk->nik ?? '') }}" placeholder="16 digit NIK" required>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $penduduk->nama ?? '') }}" placeholder="Nama sesuai KTP" required>
                </div>
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $penduduk->tempat_lahir ?? '') }}" placeholder="Kota/Kabupaten">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin">
                        <option value="">Pilih Gender</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pekerjaan</label>
                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $penduduk->pekerjaan ?? '') }}" placeholder="Contoh: Wiraswasta">
                </div>
                <div class="form-group">
                    <label>Kewarganegaraan</label>
                    <input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', $penduduk->kewarganegaraan ?? 'WNI') }}">
                </div>
                <div class="form-group">
                    <label>Status Perkawinan</label>
                    <input type="text" name="status" value="{{ old('status', $penduduk->status ?? '') }}" placeholder="Belum Kawin / Kawin">
                </div>
                <div class="form-group">
                    <label>Agama</label>
                    <input type="text" name="agama" value="{{ old('agama', $penduduk->agama ?? '') }}" placeholder="Agama">
                </div>
                <div class="form-group full-width">
                    <label>Alamat Domisili</label>
                    <textarea name="alamat" rows="2" placeholder="Nama Jalan, No. Rumah, RT/RW, Dusun...">{{ old('alamat', $penduduk->alamat ?? '') }}</textarea>
                </div>
            </div>
            
            <div style="margin-top: 16px; text-align: right;">
                <button type="submit" class="btn-premium">
                    <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Simpan Informasi
                </button>
            </div>
        </form>
    </div>

    <!-- Table Container -->
    <div class="compact-box">
        <h3 class="box-title" style="margin-bottom: 12px;">
            <svg style="width:16px; height:16px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
            </svg>
            Daftar Penduduk Terdaftar
        </h3>
        
        <div class="table-responsive-box" style="overflow-x: auto;">
            <table class="compact-table">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">Foto</th>
                        <th style="width: 160px;">NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat Domisili</th>
                        <th style="width: 140px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penduduks as $item)
                        <tr>
                            <td style="text-align: center;">
                                @if($item->foto)
                                    <img src="{{ asset($item->foto) }}" alt="Foto {{ $item->nama }}" class="avatar-mini">
                                @else
                                    <div class="avatar-placeholder-mini">N/A</div>
                                @endif
                            </td>
                            <td style="font-weight: 700; color: #0f172a;">{{ $item->nik }}</td>
                            <td style="font-weight: 600;">{{ $item->nama }}</td>
                            <td style="color: #64748b; max-width: 280px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $item->alamat }}</td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 4px; justify-content: center;">
                                    <a href="{{ route('penduduk.edit', $item) }}" class="btn-action-mini btn-edit-mini">Edit</a>
                                    <form method="POST" action="{{ route('penduduk.destroy', $item) }}" onsubmit="return confirm('Hapus data penduduk ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-mini btn-delete-mini">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #94a3b8; padding: 30px 10px; font-size: 0.85rem;">
                                📭 Belum ada data kependudukan yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Links -->
        <div style="margin-top: 14px; display: flex; justify-content: flex-end;">
            {{ $penduduks->links() }}
        </div>
    </div>
</div>
@endsection