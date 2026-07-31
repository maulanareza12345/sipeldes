@extends('layouts.app')

@section('title', 'Pengaturan - Sistem Desa')

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

    /* SPLIT GRID INTERFACE */
    .main-split-grid {
        display: grid;
        grid-template-columns: 1fr 1.6fr;
        gap: 20px;
        align-items: start;
    }
    @media (max-width: 991px) {
        .main-split-grid { 
            grid-template-columns: 1fr; 
        }
    }

    /* PREMIUM CONTENT BOX */
    .compact-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
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

    /* MODERN HIGH-DENSITY FORM CONTROLS */
    .form-group {
        margin-bottom: 12px;
    }
    label {
        display: block;
        font-weight: 700;
        font-size: 0.78rem;
        margin-bottom: 6px;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    input[type="text"], input[type="email"], input[type="password"] {
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
    input:focus {
        outline: none;
        border-color: #0f172a;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
    }

    /* COMPACT TABLE STYLING */
    .table-responsive-box {
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        overflow: hidden;
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
    .compact-table tr:last-child td { 
        border-bottom: none; 
    }

    /* BUTTONS */
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
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        box-sizing: border-box;
    }
    .btn-premium:hover {
        background: #334155;
        box-shadow: 0 4px 10px rgba(15, 23, 42, 0.15);
    }

    /* STATUS BADGES PREMIUM */
    .badge-role-mini {
        display: inline-flex;
        align-items: center;
        padding: 2px 8px;
        border-radius: 6px;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        background-color: #dbeafe;
        color: #1d4ed8;
    }

    /* ALERT STYLING */
    .alert-compact {
        padding: 10px 14px;
        border-radius: 10px;
        margin-bottom: 16px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    .alert-compact-success {
        border: 1px solid #a7f3d0;
        background: #ecfdf3; 
        color: #065f46;
    }
    .alert-compact-danger {
        border: 1px solid #fecaca;
        background: #fef2f2; 
        color: #991b1b;
    }
</style>

<div class="dashboard-compact">
    <!-- Mini Hero Banner -->
    <div class="mini-hero">
        <div>
            <span class="mini-badge-title">Manajemen Pengguna</span>
            <h1>Pengaturan Admin</h1>
            <p>Kelola akun administrator sistem. Hanya admin yang dapat menambahkan admin baru.</p>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert-compact alert-compact-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Alert Error -->
    @if(session('error'))
        <div class="alert-compact alert-compact-danger">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-compact alert-compact-danger">
            ⚠️ {{ $errors->first() }}
        </div>
    @endif

    <!-- Main Split Grid Interface -->
    <div class="main-split-grid">
        
        <!-- Left Column: Form Tambah Admin -->
        <div class="compact-box">
            <h3 class="box-title">
                <svg style="width:16px; height:16px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Tambah Admin Baru
            </h3>
            
            <form method="POST" action="{{ route('admin.settings.store') }}">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@email.com" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Buat password (min. 6 karakter)" required>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                </div>

                <button type="submit" class="btn-premium" style="width: 100%; margin-top: 6px;">
                    <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Admin
                </button>
            </form>
        </div>

        <!-- Right Column: Daftar Admin -->
        <div class="compact-box">
            <h3 class="box-title" style="margin-bottom: 12px;">
                <svg style="width:16px; height:16px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Daftar Admin
            </h3>
            
            <div class="table-responsive-box" style="overflow-x: auto;">
                <table class="compact-table">
<thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th style="width: 100px; text-align: center;">Role</th>
                            <th style="width: 100px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                            <tr>
                                <td style="font-weight: 700; color: #0f172a;">{{ $admin->name }}</td>
                                <td style="color: #64748b;">{{ $admin->email }}</td>
                                <td style="text-align: center;">
                                    <span class="badge-role-mini">{{ $admin->role }}</span>
                                </td>
                                <td style="text-align: center;">
                                    <form method="POST" action="{{ route('admin.settings.destroy', $admin->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin {{ $admin->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; cursor: pointer; color: #ef4444; font-weight: 700; font-size: 0.78rem; display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 6px; transition: all 0.2s ease;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">
                                            <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; color: #94a3b8; padding: 30px 10px; font-size: 0.85rem;">
                                    👤 Belum ada admin lain selain Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection