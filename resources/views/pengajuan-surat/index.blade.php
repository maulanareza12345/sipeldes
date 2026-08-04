@extends('layouts.app')

@section('title', 'Pengajuan Surat - Sistem Desa')

@section('content')
<!-- Google Font Premium -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* BASE DASHBOARD LAYOUT */
    .dashboard-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #0f172a;
        background-color: #f8fafc;
        font-size: 14px;
        line-height: 1.5;
        padding-bottom: 30px;
    }

    .dashboard-wrapper * {
        box-sizing: border-box;
    }

    /* MINI HERO BANNER */
    .mini-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-radius: 14px;
        padding: 20px 24px;
        color: #ffffff;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .mini-hero h1 {
        font-size: 1.3rem;
        font-weight: 800;
        letter-spacing: -0.3px;
        margin: 4px 0 2px 0;
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
        font-size: 0.72rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* CARD CONTAINER */
    .compact-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 22px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        margin-bottom: 24px;
        position: relative;
    }

    .box-title {
        margin: 0 0 16px 0;
        font-size: 1.05rem;
        color: #0f172a;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }

    /* STEPPER PROGRESS */
    .stepper-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0;
        margin-bottom: 22px;
        background: #f8fafc;
        padding: 10px 16px;
        border-radius: 10px;
        border: 1px solid #f1f5f9;
    }
    .step-item {
        display: flex;
        align-items: center;
        gap: 8px;
        flex: 1;
        cursor: pointer;
    }
    .step-item:not(:last-child)::after {
        content: '';
        flex: 1;
        height: 2px;
        background: #cbd5e1;
        margin: 0 10px;
        transition: all 0.3s ease;
    }
    .step-item.active:not(:last-child)::after,
    .step-item.completed:not(:last-child)::after {
        background: #0f172a;
    }
    .step-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.8rem;
        flex-shrink: 0;
        transition: all 0.3s ease;
        border: 2px solid #cbd5e1;
        color: #64748b;
        background: #ffffff;
    }
    .step-item.active .step-circle {
        border-color: #0f172a;
        background: #0f172a;
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.2);
    }
    .step-item.completed .step-circle {
        border-color: #10b981;
        background: #10b981;
        color: #ffffff;
    }
    .step-label {
        font-size: 0.78rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }
    .step-item.active .step-label { color: #0f172a; font-weight: 800; }
    .step-item.completed .step-label { color: #10b981; }

    @media (max-width: 640px) {
        .step-label { display: none; }
        .step-item:not(:last-child)::after { margin: 0 4px; }
    }

    /* STEP CONTENT SHOW/HIDE */
    .step-content {
        display: none;
    }
    .step-content.active {
        display: block;
    }

    /* FORM CONTROLS */
    .form-group {
        margin-bottom: 16px;
        position: relative;
    }
    .form-group label {
        display: block;
        font-weight: 700;
        font-size: 0.78rem;
        margin-bottom: 6px;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .form-control {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 0.88rem;
        background-color: #f8fafc;
        color: #0f172a;
        transition: all 0.2s ease;
        font-family: inherit;
    }
    .form-control:focus {
        outline: none;
        border-color: #0f172a;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
    }
    textarea.form-control {
        resize: vertical;
        min-height: 70px;
    }
    .required-star {
        color: #dc2626;
        margin-left: 2px;
    }

    /* GRID UNTUK FORM DUA KOLOM */
    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    @media (max-width: 640px) {
        .form-row-2 { grid-template-columns: 1fr; }
    }

    /* SEARCH AUTOCOMPLETE */
    .suggestions-box {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 50;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        max-height: 200px;
        overflow-y: auto;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        margin-top: 4px;
    }
    .suggestion-item {
        width: 100%;
        text-align: left;
        padding: 8px 12px;
        border: none;
        background: transparent;
        cursor: pointer;
        display: block;
        transition: background 0.15s ease;
        border-bottom: 1px solid #f1f5f9;
    }
    .suggestion-item:last-child { border-bottom: none; }
    .suggestion-item:hover { background-color: #f1f5f9; }

    /* INFO BANNERS */
    .info-banner {
        padding: 10px 14px;
        border-radius: 8px;
        margin-bottom: 16px;
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        line-height: 1.4;
    }
    .info-banner.default-info { background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; }
    .info-banner.wajib { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
    .info-banner.opsional { background: #fffbeb; border: 1px solid #fde68a; color: #92400e; }
    .info-banner.tidak-perlu { background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; }

    /* SURAT INFO CARD */
    .surat-info-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 14px;
        margin-bottom: 16px;
        display: none;
    }
    .surat-info-card.visible { display: block; }
    .surat-info-card .surat-name { font-weight: 800; font-size: 0.95rem; color: #0f172a; margin-bottom: 2px; }
    .surat-info-card .surat-desc { font-size: 0.82rem; color: #64748b; }
    .surat-info-card .surat-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: 8px;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
    }
.surat-info-card .surat-badge.wajib { background: #fef2f2; color: #dc2626; }
    .surat-info-card .surat-badge.opsional { background: #fffbeb; color: #d97706; }
    .surat-info-card .surat-badge.tidak-perlu { background: #ecfdf5; color: #059669; }
    .surat-info-card .surat-nomor-format {
        margin-top: 10px;
        padding: 8px 12px;
        border: 1px dashed #cbd5e1;
        border-radius: 8px;
        background: #ffffff;
        font-size: 0.82rem;
        color: #0f172a;
        display: none;
    }
    .surat-info-card .surat-nomor-format.visible { display: block; }
    .surat-info-card .surat-nomor-format .format-label {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        color: #64748b;
        margin-bottom: 3px;
    }
    .surat-info-card .surat-nomor-format .format-value {
        font-weight: 700;
        font-size: 0.9rem;
        letter-spacing: 0.3px;
        color: #0f172a;
        word-break: break-all;
    }
    .surat-info-card .surat-nomor-format .format-note {
        font-size: 0.72rem;
        color: #94a3b8;
        margin-top: 3px;
        font-weight: 500;
    }

    /* BUTTONS */
    .btn {
        padding: 8px 18px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.82rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
    }
    .btn-dark { background: #0f172a; color: #ffffff; }
    .btn-dark:hover { background: #1e293b; box-shadow: 0 2px 8px rgba(15, 23, 42, 0.15); }
    .btn-light { background: #f1f5f9; color: #475569; border-color: #cbd5e1; }
    .btn-light:hover { background: #e2e8f0; }
    .btn-success { background: #059669; color: #ffffff; }
    .btn-success:hover { background: #047857; box-shadow: 0 2px 8px rgba(5, 150, 105, 0.2); }

    .nav-buttons {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
    }

    /* TABLE STYLING */
    .table-container {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow-x: auto;
        background: #ffffff;
    }
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .data-table th {
        background: #f8fafc;
        padding: 10px 14px;
        font-weight: 700;
        color: #475569;
        font-size: 0.75rem;
        text-transform: uppercase;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }
    .data-table td {
        padding: 10px 14px;
        font-size: 0.85rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    .data-table tbody tr:hover td { background-color: #f8fafc; }
    .data-table tr:last-child td { border-bottom: none; }

    /* BADGES & ACTIONS */
    .badge-status {
        display: inline-flex;
        align-items: center;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    .badge-status.disetujui { background: #ccfbf1; color: #0f766e; }
    .badge-status.pending { background: #fef3c7; color: #92400e; }
    .badge-status.ditolak { background: #fee2e2; color: #991b1b; }

    .action-group {
        display: flex;
        align-items: center;
        gap: 4px;
        justify-content: center;
    }
    .btn-action {
        padding: 4px 10px;
        font-size: 0.75rem;
        border-radius: 6px;
        font-weight: 700;
        text-decoration: none;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.15s ease;
        white-space: nowrap;
    }
    .btn-action-approve { background: #ecfdf5; color: #059669; border-color: #a7f3d0; }
    .btn-action-approve:hover { background: #d1fae5; }
    .btn-action-reject { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
    .btn-action-reject:hover { background: #fee2e2; }
    .btn-action-pdf { background: #f8fafc; color: #475569; border-color: #cbd5e1; }
    .btn-action-pdf:hover { background: #f1f5f9; color: #0f172a; }
    .btn-action-delete { background: #fef2f2; color: #ef4444; border-color: #fee2e2; }
    .btn-action-delete:hover { background: #fee2e2; }

    /* DYNAMIC FAMILY TABLE FORM */
    .table-keluarga-form {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.82rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }
    .table-keluarga-form th {
        background: #f8fafc;
        padding: 8px;
        border: 1px solid #e2e8f0;
        text-align: center;
        font-weight: 700;
        color: #475569;
    }
    .table-keluarga-form td {
        padding: 6px;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
    }
    .keluarga-input {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 4px 8px;
        font-size: 0.8rem;
        background: #ffffff;
    }
    .keluarga-input:focus { border-color: #0f172a; outline: none; }
</style>

<div class="dashboard-wrapper">
    <!-- Hero Banner -->
    <div class="mini-hero">
        <div>
            <span class="mini-badge-title">Layanan Surat Online</span>
            <h1>Ajukan Surat Baru</h1>
            <p>Isi data pemohon, pilih jenis surat, lengkapi data khusus & dokumen pendukung.</p>
        </div>
    </div>

    <!-- Alert System Notifications -->
    @if(session('success'))
        <div class="info-banner" style="background:#ecfdf5; border-color:#a7f3d0; color:#065f46;">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="info-banner wajib">
            ⚠️ Terdapat kesalahan dalam pengisian formulir. Silakan periksa kembali data Anda.
        </div>
    @endif

    <!-- TAMPILAN ATAS: FORMULIR PENGAJUAN SURAT -->
    <div class="compact-box">
        <h3 class="box-title">
            <svg style="width:18px; height:18px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Formulir Pengajuan Surat
        </h3>

        <!-- Stepper Progress Bar -->
        <div class="stepper-wrapper">
            <div class="step-item active" data-step="1">
                <div class="step-circle">1</div>
                <span class="step-label">Pemohon</span>
            </div>
            <div class="step-item" data-step="2">
                <div class="step-circle">2</div>
                <span class="step-label">Surat & Data</span>
            </div>
            <div class="step-item" data-step="3">
                <div class="step-circle">3</div>
                <span class="step-label">Dokumen</span>
            </div>
        </div>

        <form method="POST" action="{{ route('pengajuan-surat.store') }}" enctype="multipart/form-data" id="mainForm">
            @csrf

            <!-- Hidden Input: Penduduk ID -->
            <input type="hidden" name="penduduk_id" id="penduduk_id" required>

            <!-- STEP 1: PENCARIAN PEMOHON -->
            <div class="step-content active" id="step1">
                <div class="info-banner default-info">
                    📋 Silakan cari dan pilih data penduduk yang akan mengajukan surat.
                </div>

                <div class="form-group">
                    <label>Cari Data Penduduk <span class="required-star">*</span></label>
                    <div style="display:flex; gap:8px; align-items:center;">
                        <input
                            type="text"
                            id="penduduk_search"
                            class="form-control"
                            placeholder="Ketik nama lengkap atau NIK penduduk..."
                            autocomplete="off"
                            style="flex:1;"
                        />
                        <button type="button" class="btn btn-dark" id="penduduk_search_btn">
                            🔍 Cari
                        </button>
                    </div>
                    <div id="penduduk_suggestions" class="suggestions-box" style="display: none;"></div>
                    @error('penduduk_id')
                        <div style="color:#dc2626; font-size:0.8rem; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- STEP 2: JENIS SURAT & DATA SPESIFIK -->
            <div class="step-content" id="step2">
                <div class="info-banner default-info">
                    📄 Pilih jenis surat yang dibutuhkan, lalu isi data khusus yang sesuai.
                </div>

                <div class="form-group">
                    <label>Jenis Dokumen Surat <span class="required-star">*</span></label>
                    <select name="jenis_surat_id" id="jenis_surat_id" class="form-control" required>
                        <option value="">— Pilih jenis layanan surat —</option>
@foreach($jenisSurats as $item)
                            <option
                                value="{{ $item->id }}"
                                data-fields='{{ json_encode($item->fields_config ?? []) }}'
                                data-surat-pengantar="{{ $item->surat_pengantar ?? 'wajib' }}"
                                data-nomor-format="{{ $nomorSuratFormats[$item->nama] ?? '400/{no_surat}/VII/pem' }}"
                            >
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_surat_id')
                        <div style="color:#dc2626; font-size:0.8rem; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

<!-- Informasi Surat Card -->
                <div class="surat-info-card" id="suratInfoCard">
                    <div class="surat-name" id="suratInfoName"></div>
                    <div class="surat-desc" id="suratInfoDesc"></div>
                    <div class="surat-badge" id="suratInfoBadge"></div>
                    <div class="surat-nomor-format" id="suratNomorFormat"></div>
                </div>

                <!-- Dynamic Fields Container -->
                <div id="dynamic_fields_container" style="display: none;"></div>

                <!-- Keterangan Tambahan -->
                <div class="form-group" style="margin-top:16px; padding-top:16px; border-top:1px dashed #e2e8f0;">
                    <label>Keterangan Tambahan / Keperluan</label>
                    <textarea name="keterangan" class="form-control" placeholder="Contoh: Syarat Klaim BPJS, Pindah Domisili, Beasiswa, dll.">{{ old('keterangan') }}</textarea>
                </div>
            </div>

            <!-- STEP 3: UNGGAH DOKUMEN & PENGANTAR -->
            <div class="step-content" id="step3">
                <div class="info-banner default-info">
                    📎 Unggah dokumen persyaratan dan isi surat pengantar RT/RW jika diperlukan.
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Upload Foto KTP <span class="required-star">*</span></label>
                        <input type="file" name="foto_ktp" class="form-control" accept="image/*,application/pdf" required />
                        <div style="font-size:0.72rem; color:#94a3b8; margin-top:4px;">Format: JPG/PNG/PDF, maks 5MB</div>
                        @error('foto_ktp')
                            <div style="color:#dc2626; font-size:0.8rem; margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>NIK KTP <span class="required-star">*</span></label>
                        <input type="text" name="nik_ktp" class="form-control" maxlength="16" inputmode="numeric" placeholder="Contoh: 3201xxxxxxxxxx" value="{{ old('nik_ktp') }}" required />
                        @error('nik_ktp')
                            <div style="color:#dc2626; font-size:0.8rem; margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Upload Foto KK <span class="required-star">*</span></label>
                        <input type="file" name="foto_kk" class="form-control" accept="image/*,application/pdf" required />
                        <div style="font-size:0.72rem; color:#94a3b8; margin-top:4px;">Format: JPG/PNG/PDF, maks 5MB</div>
                        @error('foto_kk')
                            <div style="color:#dc2626; font-size:0.8rem; margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>NIK KK <span class="required-star">*</span></label>
                        <input
                            type="text"
                            name="nik_kk"
                            id="nik_kk_input"
                            class="form-control"
                            maxlength="16"
                            inputmode="numeric"
                            placeholder="Contoh: 3201xxxxxxxxxx"
                            value="{{ old('nik_kk') }}"
                            required
                        />
                        <div id="nik_kk_mismatch" style="display:none; color:#dc2626; font-size:0.8rem; margin-top:4px; font-weight:600;">
                            ⚠️ NIK KK tidak sesuai dengan NIK KTP yang diisi.
                        </div>
                        @error('nik_kk')
                            <div style="color:#dc2626; font-size:0.8rem; margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Conditional Surat Pengantar Wrapper -->
                <div id="surat_pengantar_wrapper" style="display: none;">
                    <div class="form-group">
                        <label>
                            Surat Pengantar dari RT/RW
                            <span class="required-star" id="surat_pengantar_required_star" style="display:none;">*</span>
                        </label>
                        <div id="surat_pengantar_info" class="info-banner" style="margin-bottom:10px;"></div>
                        <textarea
                            name="surat_pengantar_rt_rw"
                            id="surat_pengantar_rt_rw"
                            class="form-control"
                            placeholder="Tulis/isi surat pengantar dari RT/RW (misal: No. surat, tanggal, dan keterangan singkat)"
                        >{{ old('surat_pengantar_rt_rw') }}</textarea>
                        @error('surat_pengantar_rt_rw')
                            <div style="color:#dc2626; font-size:0.8rem; margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Data Penandatangan -->
                <div class="form-group" style="padding-top:14px; border-top:1px dashed #e2e8f0; margin-top:14px;">
                    <label style="color:#0f172a;">👤 Data Penandatangan (Opsional)</label>
                    <div class="form-row-2" style="margin-top:6px;">
                        <div>
                            <label style="font-size:0.72rem;">Nama Penandatangan</label>
                            <input type="text" name="nama_ttd" class="form-control" placeholder="Nama pejabat" value="{{ old('nama_ttd') }}" />
                        </div>
                        <div>
                            <label style="font-size:0.72rem;">Jabatan Penandatangan</label>
                            <input type="text" name="jabatan_ttd" class="form-control" placeholder="Kepala Desa / Sekdes" value="{{ old('jabatan_ttd') }}" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigasi Tombol Stepper -->
            <div class="nav-buttons">
                <button type="button" class="btn btn-light" id="prevBtn" style="visibility:hidden;">
                    ← Sebelumnya
                </button>
                <button type="button" class="btn btn-dark" id="nextBtn">
                    Selanjutnya →
                </button>
                <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">
                    ✅ Kirim Berkas Pengajuan
                </button>
            </div>

        </form>
    </div>

    <!-- TAMPILAN BAWAH: DAFTAR ANTREAN PENGAJUAN SURAT -->
    <div class="compact-box">
        <h3 class="box-title">
            <svg style="width:18px; height:18px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            Daftar Antrean Pengajuan
        </h3>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Pemohon</th>
                        <th>Jenis Surat</th>
                        <th style="width: 110px; text-align: center;">Status</th>
                        <th style="width: 160px; text-align: center;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuanSurats as $item)
                        <tr>
                            <td style="font-weight: 700; color: #0f172a;">{{ $item->penduduk->nama ?? '-' }}</td>
                            <td style="font-weight: 500;">{{ $item->jenisSurat->nama ?? '-' }}</td>
                            <td style="text-align: center;">
                                @php $statusLower = Str::lower($item->status); @endphp
                                <span class="badge-status {{ $statusLower }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td>
                                <div class="action-group">
                                    @if($statusLower === 'pending')
                                        <form method="POST" action="{{ route('pengajuan-surat.approve', $item) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-action btn-action-approve" title="Setujui Dokumen">Setuju</button>
                                        </form>
                                        <form method="POST" action="{{ route('pengajuan-surat.reject', $item) }}" style="display:inline;" onsubmit="return confirm('Tolak permohonan surat ini?')">
                                            @csrf
                                            <button type="submit" class="btn-action btn-action-reject" title="Tolak Dokumen">Tolak</button>
                                        </form>
                                        <form method="POST" action="{{ route('pengajuan-surat.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Hapus pengajuan surat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-action-delete" title="Hapus Pengajuan">Hapus</button>
                                        </form>
                                    @elseif($statusLower === 'ditolak')
                                        <form method="POST" action="{{ route('pengajuan-surat.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Hapus pengajuan surat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-action-delete" title="Hapus Pengajuan">Hapus</button>
                                        </form>
                                    @endif

                                    @if(!empty($item->nomor_surat))
                                        <a href="{{ route('pengajuan-surat.pdf', $item) }}" class="btn-action btn-action-pdf" style="display: inline-flex; align-items: center; gap: 3px;">
                                            <svg style="width:12px; height:12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Cetak
                                        </a>
                                        <form method="POST" action="{{ route('pengajuan-surat.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Hapus pengajuan surat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-action-delete" title="Hapus Pengajuan">Hapus</button>
                                        </form>
                                    @else
                                        @if($statusLower !== 'pending')
                                            <span style="color: #94a3b8; font-size: 0.75rem; font-style: italic; white-space: nowrap;">Menunggu No. Surat</span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: #94a3b8; padding: 30px 10px; font-size: 0.85rem;">
                                📭 Belum ada riwayat pengajuan surat saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 14px; display: flex; justify-content: flex-end;">
            {{ $pengajuanSurats->links() }}
        </div>
    </div>
</div>

<!-- =========================================================
     JAVASCRIPT LOGIC
     ========================================================= -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // 1. STEPPER NAVIGATION LOGIC
    const totalSteps = 3;
    let currentStep = 1;

    const stepItems = document.querySelectorAll('.step-item');
    const stepContents = document.querySelectorAll('.step-content');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');

    function updateStepper() {
        stepItems.forEach((el, idx) => {
            const stepNum = idx + 1;
            el.classList.remove('active', 'completed');
            if (stepNum === currentStep) {
                el.classList.add('active');
            } else if (stepNum < currentStep) {
                el.classList.add('completed');
            }
        });

        stepContents.forEach((el, idx) => {
            el.classList.toggle('active', (idx + 1) === currentStep);
        });

        prevBtn.style.visibility = currentStep === 1 ? 'hidden' : 'visible';
        nextBtn.style.display = currentStep === totalSteps ? 'none' : 'inline-flex';
        submitBtn.style.display = currentStep === totalSteps ? 'inline-flex' : 'none';
    }

    function goToStep(step) {
        if (step < 1 || step > totalSteps) return;

        if (step > currentStep) {
            if (!validateStep(currentStep)) return;
        }

        currentStep = step;
        updateStepper();
    }

    function validateStep(step) {
        if (step === 1) {
            const pendudukId = document.getElementById('penduduk_id').value;
            if (!pendudukId) {
                alert('Silakan cari dan pilih data penduduk terlebih dahulu.');
                document.getElementById('penduduk_search').focus();
                return false;
            }
        }
        if (step === 2) {
            const jenisSurat = document.getElementById('jenis_surat_id').value;
            if (!jenisSurat) {
                alert('Silakan pilih jenis surat terlebih dahulu.');
                return false;
            }
        }
        return true;
    }

    prevBtn.addEventListener('click', () => goToStep(currentStep - 1));
    nextBtn.addEventListener('click', () => goToStep(currentStep + 1));

    stepItems.forEach((el, idx) => {
        el.addEventListener('click', () => {
            const stepNum = idx + 1;
            if (stepNum < currentStep) {
                goToStep(stepNum);
            }
        });
    });

    updateStepper();

    // 2. AUTOCOMPLETE PENDUDUK SEARCH
    const searchInput = document.getElementById('penduduk_search');
    const searchBtn = document.getElementById('penduduk_search_btn');
    const hiddenPendudukId = document.getElementById('penduduk_id');
    const suggestionsBox = document.getElementById('penduduk_suggestions');

    const escapeHtml = (str) => {
        return String(str || '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    };

    const renderSuggestions = (items) => {
        suggestionsBox.innerHTML = '';
        if (!items || items.length === 0) {
            suggestionsBox.innerHTML = '<div style="color:#94a3b8; font-size:0.8rem; padding:8px 12px;">Tidak ada penduduk yang cocok.</div>';
            suggestionsBox.style.display = 'block';
            return;
        }

        items.forEach((item) => {
            const row = document.createElement('button');
            row.type = 'button';
            row.className = 'suggestion-item';
            row.innerHTML = `<div style="font-weight:700; color:#0f172a; font-size:0.82rem;">${escapeHtml(item.nama ?? '-')}</div>` +
                            `<div style="color:#64748b; font-size:0.75rem;">NIK: ${escapeHtml(item.nik ?? '-')}</div>`;
            
            row.addEventListener('click', () => {
                hiddenPendudukId.value = item.id;
                searchInput.value = `${item.nama ?? '-'} — ${item.nik ?? '-'}`;
                suggestionsBox.style.display = 'none';
                searchInput.style.borderColor = '#059669';
                searchInput.style.backgroundColor = '#f0fdf4';
            });

            suggestionsBox.appendChild(row);
        });
        suggestionsBox.style.display = 'block';
    };

    const doSearch = async () => {
        const query = (searchInput.value || '').trim();
        if (query.length === 0) {
            hiddenPendudukId.value = '';
            suggestionsBox.innerHTML = '';
            suggestionsBox.style.display = 'none';
            searchInput.style.borderColor = '#cbd5e1';
            searchInput.style.backgroundColor = '#f8fafc';
            return;
        }
        searchBtn.disabled = true;
        searchBtn.textContent = '...';
        try {
            const url = '{{ route("pengajuan-surat.penduduk.search") }}' + '?query=' + encodeURIComponent(query);
            const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
            const data = await res.json();
            renderSuggestions(data);
        } catch (e) {
            suggestionsBox.innerHTML = '<div style="color:#dc2626; font-size:0.8rem; padding:8px 12px;">Gagal mencari data penduduk.</div>';
            suggestionsBox.style.display = 'block';
        } finally {
            searchBtn.disabled = false;
            searchBtn.textContent = '🔍 Cari';
        }
    };

    searchBtn.addEventListener('click', doSearch);
    searchInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            doSearch();
        }
    });

    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target) && !searchBtn.contains(e.target)) {
            suggestionsBox.style.display = 'none';
        }
    });

    const form = document.getElementById('mainForm');
    if (form) {
        form.addEventListener('submit', async (e) => {
            if (hiddenPendudukId.value) return;
            const q = (searchInput.value || '').trim();
            if (!q) return;
            e.preventDefault();
            try {
                const url = '{{ route("pengajuan-surat.penduduk.search") }}' + '?query=' + encodeURIComponent(q);
                const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                const data = await res.json();
                if (data && data.length > 0) {
                    hiddenPendudukId.value = data[0].id;
                    searchInput.value = `${data[0].nama ?? '-'} — ${data[0].nik ?? '-'}`;
                    form.submit();
                } else {
                    alert('Nama/NIK penduduk tidak ditemukan. Pastikan memilih rekomendasi yang muncul.');
                }
            } catch (err) {
                alert('Gagal mengambil data penduduk untuk pengajuan.');
            }
        });
    }

    // 3. MATCH CHECK NIK
    const nikKtpInput = document.querySelector('input[name="nik_ktp"]');
    const nikKkInput = document.getElementById('nik_kk_input');
    const mismatchBox = document.getElementById('nik_kk_mismatch');

    const checkNikMatch = () => {
        if (!nikKtpInput || !nikKkInput || !mismatchBox) return;
        const nikKtp = (nikKtpInput.value || '').replace(/\s+/g, '');
        const nikKk = (nikKkInput.value || '').replace(/\s+/g, '');

        if (nikKtp.length === 16 && nikKk.length === 16 && nikKtp !== nikKk) {
            mismatchBox.style.display = 'block';
        } else {
            mismatchBox.style.display = 'none';
        }
    };

    if (nikKtpInput) nikKtpInput.addEventListener('input', checkNikMatch);
    if (nikKkInput) nikKkInput.addEventListener('input', checkNikMatch);

    // 4. DYNAMIC FIELDS & INFORMASI SURAT
    const jenisSelect = document.getElementById('jenis_surat_id');
    const dynContainer = document.getElementById('dynamic_fields_container');
    const suratInfoCard = document.getElementById('suratInfoCard');
    const suratInfoName = document.getElementById('suratInfoName');
    const suratInfoDesc = document.getElementById('suratInfoDesc');
const suratInfoBadge = document.getElementById('suratInfoBadge');
    const suratNomorFormat = document.getElementById('suratNomorFormat');
    const suratPengantarWrapper = document.getElementById('surat_pengantar_wrapper');
    const suratPengantarTextarea = document.getElementById('surat_pengantar_rt_rw');
    const suratPengantarInfo = document.getElementById('surat_pengantar_info');
    const suratPengantarRequiredStar = document.getElementById('surat_pengantar_required_star');

    const suratDescriptions = {
        'Surat Keterangan Domisili': 'Untuk penduduk yang membutuhkan bukti domisili di wilayah desa.',
        'Surat Pengantar KTP': 'Sebagai pengantar pembuatan/rekam KTP di Dukcapil.',
        'Surat Pengantar KK': 'Sebagai pengantar pembuatan/perubahan Kartu Keluarga.',
        'Surat Keterangan Usaha': 'Untuk melengkapi persyaratan pengajuan pinjaman atau keperluan usaha lainnya.',
        'Surat Keterangan Tidak Mampu': 'Untuk keperluan pengajuan bantuan sosial, beasiswa, atau keringanan biaya.',
        'Surat Keterangan Kelahiran': 'Untuk mencatatkan kelahiran sebagai dasar pembuatan Akta Kelahiran.',
        'Surat Keterangan Kematian': 'Untuk mencatatkan kematian sebagai dasar pembuatan Akta Kematian.',
        'Surat Pindah': 'Untuk penduduk yang akan pindah ke luar desa/kecamatan.',
        'Surat Kehilangan': 'Untuk melaporkan kehilangan barang/dokumen secara resmi.',
        'Surat Izin Keramaian': 'Untuk mengurus izin kegiatan/acara yang melibatkan banyak orang.',
        'Surat Pengantar Nikah': 'Sebagai pengantar pendaftaran pernikahan di KUA.',
        'Surat Ahli Waris': 'Untuk penetapan ahli waris bagi pewaris yang telah meninggal.',
        'Surat Bebas Sengketa': 'Untuk menyatakan bahwa suatu objek tidak dalam status sengketa.',
    };

    function updateSuratInfo(selectedText) {
        if (!selectedText || selectedText === '— Pilih jenis layanan surat —') {
            suratInfoCard.classList.remove('visible');
            return;
        }
        suratInfoCard.classList.add('visible');
        suratInfoName.textContent = selectedText;
        suratInfoDesc.textContent = suratDescriptions[selectedText] || 'Silakan lengkapi data khusus di bawah ini.';

        const selectedOption = jenisSelect.options[jenisSelect.selectedIndex];
        const suratPengantar = selectedOption ? selectedOption.dataset.suratPengantar : 'wajib';

        let badgeText = '';
        let badgeClass = '';
        if (suratPengantar === 'wajib') {
            badgeText = '📎 Lampiran Surat Pengantar RT/RW: Wajib';
            badgeClass = 'wajib';
        } else if (suratPengantar === 'opsional') {
            badgeText = '📎 Lampiran Surat Pengantar RT/RW: Opsional';
            badgeClass = 'opsional';
        } else {
            badgeText = '📎 Lampiran Surat Pengantar RT/RW: Tidak Perlu';
            badgeClass = 'tidak-perlu';
        }
suratInfoBadge.textContent = badgeText;
        suratInfoBadge.className = 'surat-badge ' + badgeClass;

        // Tampilkan format nomor surat sesuai jenis surat yang dipilih
        const nomorFormat = selectedOption ? selectedOption.dataset.nomorFormat : '';
        if (suratNomorFormat && nomorFormat) {
            suratNomorFormat.classList.add('visible');
            suratNomorFormat.innerHTML =
                '<div class="format-label">🔢 Format Nomor Surat</div>' +
                '<div class="format-value">' + escapeHtml(nomorFormat) + '</div>' +
                '<div class="format-note">Nomor urut (…) akan diisi otomatis saat surat disetujui.</div>';
        } else if (suratNomorFormat) {
            suratNomorFormat.classList.remove('visible');
            suratNomorFormat.innerHTML = '';
        }

        updateSuratPengantarSection(suratPengantar);
    }

    function updateSuratPengantarSection(aturan) {
        if (!suratPengantarWrapper) return;

        if (aturan === 'tidak_perlu') {
            suratPengantarWrapper.style.display = 'none';
            suratPengantarTextarea.removeAttribute('required');
        } else if (aturan === 'opsional') {
            suratPengantarWrapper.style.display = 'block';
            suratPengantarTextarea.removeAttribute('required');
            suratPengantarInfo.className = 'info-banner opsional';
            suratPengantarInfo.innerHTML = '📌 Surat Pengantar RT/RW bersifat <strong>OPSIONAL</strong> untuk surat ini. Anda dapat mengisinya jika sudah ada.';
            suratPengantarRequiredStar.style.display = 'none';
        } else {
            suratPengantarWrapper.style.display = 'block';
            suratPengantarTextarea.setAttribute('required', 'required');
            suratPengantarInfo.className = 'info-banner wajib';
            suratPengantarInfo.innerHTML = '⚠️ Surat Pengantar RT/RW <strong>WAJIB</strong> dilampirkan untuk surat ini.';
            suratPengantarRequiredStar.style.display = 'inline';
        }
    }

    function renderDynamicFields() {
        const selected = jenisSelect.options[jenisSelect.selectedIndex];
        let fields = [];
        try {
            if (selected && selected.dataset.fields) {
                fields = JSON.parse(selected.dataset.fields);
            }
        } catch (e) {
            fields = [];
        }

        dynContainer.innerHTML = '';
        if (!fields || fields.length === 0) {
            dynContainer.style.display = 'none';
            return;
        }

        dynContainer.style.display = 'block';

        const divider = document.createElement('div');
        divider.style.cssText = 'border-top: 1px dashed #cbd5e1; margin: 16px 0;';
        dynContainer.appendChild(divider);

        const sectionLabel = document.createElement('div');
        sectionLabel.style.cssText = 'font-weight: 700; font-size: 0.82rem; color: #0f172a; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;';
        sectionLabel.innerHTML = `📋 Data Khusus <span style="color:#64748b; font-weight:500; font-size:0.75rem;">(${selected ? selected.text : ''})</span>`;
        dynContainer.appendChild(sectionLabel);

        const fieldsGrid = document.createElement('div');
        fieldsGrid.className = 'form-row-2';

        let keluargaTableContainer = null;

        fields.forEach((field) => {
            const fieldName = 'dynamic_' + field.name;
            const requiredStar = field.required ? ' <span class="required-star">*</span>' : '';

            if (field.name === 'keluarga_pindah') {
                const hiddenInput = document.createElement('textarea');
                hiddenInput.name = 'dynamic_keluarga_pindah';
                hiddenInput.id = 'dynamic_keluarga_pindah';
                hiddenInput.style.display = 'none';
                hiddenInput.value = '[]';
                dynContainer.appendChild(hiddenInput);

                keluargaTableContainer = document.createElement('div');
                keluargaTableContainer.className = 'form-group';
                keluargaTableContainer.style.gridColumn = '1 / -1';
                keluargaTableContainer.innerHTML = `
                    <label>ANGGOTA KELUARGA YANG PINDAH</label>
                    <div style="margin-bottom: 8px; overflow-x: auto;">
                        <table class="table-keluarga-form" id="keluarga_table">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">No</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Tgl Lahir</th>
                                    <th>SHDK</th>
                                    <th style="width: 40px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="keluarga_table_body">
                                <tr>
                                    <td style="text-align: center;">1</td>
                                    <td><input type="text" class="keluarga-input nik-input" placeholder="NIK"></td>
                                    <td><input type="text" class="keluarga-input nama-input" placeholder="Nama"></td>
                                    <td><input type="date" class="keluarga-input tgl-input"></td>
                                    <td>
                                        <select class="keluarga-input shdk-input">
                                            <option value="">Pilih</option>
                                            <option value="Kepala Keluarga">Kepala Keluarga</option>
                                            <option value="Istri">Istri</option>
                                            <option value="Suami">Suami</option>
                                            <option value="Anak">Anak</option>
                                            <option value="Famili Lain">Famili Lain</option>
                                        </select>
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn-remove-row" style="background:#fee2e2; color:#dc2626; border:none; border-radius:4px; padding:3px 8px; cursor:pointer; font-size:0.75rem; font-weight:700;">X</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" id="btn_add_keluarga" class="btn btn-light" style="padding:5px 12px; font-size:0.78rem; font-weight:700; color:#16a34a; background:#f0fdf4; border-color:#bbf7d0;">+ Tambah Anggota</button>
                `;
                dynContainer.appendChild(keluargaTableContainer);
                return;
            }

            if (field.type === 'hidden' || field.show === false) return;

            const group = document.createElement('div');
            group.className = 'form-group';

            if (field.type === 'textarea') {
                group.style.gridColumn = '1 / -1';
            }

            const label = document.createElement('label');
            label.innerHTML = field.label + requiredStar;
            group.appendChild(label);

            if (field.type === 'textarea') {
                const textarea = document.createElement('textarea');
                textarea.name = fieldName;
                textarea.className = 'form-control';
                textarea.placeholder = 'Masukkan ' + field.label.toLowerCase();
                if (field.required) textarea.required = true;
                group.appendChild(textarea);
            } else if (field.type === 'select' && field.options) {
                const select = document.createElement('select');
                select.name = fieldName;
                select.className = 'form-control';
                if (field.required) select.required = true;
                const emptyOpt = document.createElement('option');
                emptyOpt.value = '';
                emptyOpt.textContent = 'Pilih ' + field.label;
                select.appendChild(emptyOpt);
                field.options.forEach((optVal) => {
                    const opt = document.createElement('option');
                    opt.value = optVal;
                    opt.textContent = optVal;
                    select.appendChild(opt);
                });
                group.appendChild(select);
            } else if (field.type === 'date') {
                const input = document.createElement('input');
                input.type = 'date';
                input.name = fieldName;
                input.className = 'form-control';
                if (field.required) input.required = true;
                group.appendChild(input);
            } else {
                const input = document.createElement('input');
                input.type = 'text';
                input.name = fieldName;
                input.className = 'form-control';
                input.placeholder = 'Masukkan ' + field.label.toLowerCase();
                if (field.required) input.required = true;
                group.appendChild(input);
            }

            fieldsGrid.appendChild(group);
        });

        dynContainer.appendChild(fieldsGrid);

        if (keluargaTableContainer) {
            initKeluargaTable();
        }
    }

    // 5. FAMILY TABLE DYNAMIC ROWS & SYNC
    function syncKeluargaData() {
        const hiddenInput = document.getElementById('dynamic_keluarga_pindah');
        if (!hiddenInput) return;
        const rows = document.querySelectorAll('#keluarga_table_body tr');
        const data = [];
        rows.forEach((row) => {
            const nik = row.querySelector('.nik-input')?.value || '';
            const nama = row.querySelector('.nama-input')?.value || '';
            const tgl = row.querySelector('.tgl-input')?.value || '';
            const shdk = row.querySelector('.shdk-input')?.value || '';
            if (nama || nik) {
                data.push({ nik, nama, tgl_lahir: tgl, shdk });
            }
        });
        hiddenInput.value = JSON.stringify(data);
    }

    function initKeluargaTable() {
        const addBtn = document.getElementById('btn_add_keluarga');
        if (addBtn) {
            addBtn.addEventListener('click', function() {
                const tbody = document.getElementById('keluarga_table_body');
                const rowCount = tbody.querySelectorAll('tr').length;
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td style="text-align: center;">${rowCount + 1}</td>
                    <td><input type="text" class="keluarga-input nik-input" placeholder="NIK"></td>
                    <td><input type="text" class="keluarga-input nama-input" placeholder="Nama"></td>
                    <td><input type="date" class="keluarga-input tgl-input"></td>
                    <td>
                        <select class="keluarga-input shdk-input">
                            <option value="">Pilih</option>
                            <option value="Kepala Keluarga">Kepala Keluarga</option>
                            <option value="Istri">Istri</option>
                            <option value="Suami">Suami</option>
                            <option value="Anak">Anak</option>
                            <option value="Famili Lain">Famili Lain</option>
                        </select>
                    </td>
                    <td style="text-align: center;">
                        <button type="button" class="btn-remove-row" style="background:#fee2e2; color:#dc2626; border:none; border-radius:4px; padding:3px 8px; cursor:pointer; font-size:0.75rem; font-weight:700;">X</button>
                    </td>
                `;
                tbody.appendChild(newRow);
                updateRowNumbers();
                syncKeluargaData();
            });
        }
    }

    function updateRowNumbers() {
        const rows = document.querySelectorAll('#keluarga_table_body tr');
        rows.forEach((row, idx) => {
            const firstTd = row.querySelector('td:first-child');
            if (firstTd) firstTd.textContent = idx + 1;
        });
    }

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-remove-row')) {
            const tbody = document.getElementById('keluarga_table_body');
            if (tbody && tbody.querySelectorAll('tr').length > 1) {
                e.target.closest('tr').remove();
                updateRowNumbers();
                syncKeluargaData();
            } else {
                alert('Minimal harus ada 1 anggota keluarga.');
            }
        }
    });

    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('keluarga-input')) syncKeluargaData();
    });

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('keluarga-input')) syncKeluargaData();
    });

    // 6. INITIALIZATION
    if (jenisSelect) {
        jenisSelect.addEventListener('change', function() {
            const selectedText = jenisSelect.options[jenisSelect.selectedIndex]?.text || '';
            updateSuratInfo(selectedText);
            renderDynamicFields();
        });

        if (jenisSelect.value) {
            const selectedText = jenisSelect.options[jenisSelect.selectedIndex]?.text || '';
            updateSuratInfo(selectedText);
            renderDynamicFields();
        }
    }

});
</script>
@endsection