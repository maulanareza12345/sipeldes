@extends('layouts.app')

@section('title', 'Pengajuan Surat - Sistem Desa')

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
        .main-split-grid { grid-template-columns: 1fr; }
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
    input[type="text"], select, textarea {
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
    textarea {
        resize: vertical;
        min-height: 60px;
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
    .compact-table tr:last-child td { border-bottom: none; }

    /* ACTION BUTTONS & PREMIUM BUTTONS */
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
    

    
    .action-stack {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .btn-action-mini {
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
    .btn-approve-mini { background: #ecfdf5; color: #059669; border-color: #a7f3d0; }
    .btn-approve-mini:hover { background: #d1fae5; }
    
    .btn-reject-mini { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
    .btn-reject-mini:hover { background: #fee2e2; }
    
    .btn-pdf-mini { background: #f8fafc; color: #475569; border-color: #cbd5e1; }
    .btn-pdf-mini:hover { background: #f1f5f9; color: #1e293b; }

    .btn-delete-mini { background: #fef2f2; color: #ef4444; border-color: #fee2e2; }
    .btn-delete-mini:hover { background: #fee2e2; }

    /* STATUS BADGES PREMIUM */
    .status-badge-mini {
        display: inline-flex;
        align-items: center;
        padding: 2px 8px;
        border-radius: 6px;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .status-badge-mini.disetujui { background-color: #ccfbf1; color: #115e59; }
    .status-badge-mini.pending { background-color: #fef3c7; color: #92400e; }
    .status-badge-mini.ditolak { background-color: #fee2e2; color: #991b1b; }

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
            <span class="mini-badge-title">Layanan Surat Online</span>
            <h1>Kelola Pengajuan Surat</h1>
            <p>Proses administrasi permohonan berkas, verifikasi status, dan cetak dokumen resmi kependudukan.</p>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert-compact">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Main Split Grid Interface -->
    <div class="main-split-grid">
        
        <!-- Left Column: Form Pengajuan -->
        <div class="compact-box">
            <h3 class="box-title">
                <svg style="width:16px; height:16px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Ajukan Surat Baru
            </h3>
            
            <form method="POST" action="{{ route('pengajuan-surat.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama Pemohon (Penduduk)</label>
                    <div style="display:flex; gap:6px; align-items:center;">
                        <input
                            type="text"
                            id="penduduk_search"
                            placeholder="Ketik nama / NIK penduduk..."
                            autocomplete="off"
                            style="flex:1;"
                        />
                        <button type="button" class="btn-premium" style="padding: 8px 14px;" id="penduduk_search_btn">
                            Cari
                        </button>
                    </div>

                    <input type="hidden" name="penduduk_id" id="penduduk_id" required>

                    <div id="penduduk_suggestions" style="margin-top:6px; position: relative; z-index: 10;">
                        {{-- suggestions will be injected here --}}
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Jenis Dokumen Surat</label>
                    <select name="jenis_surat_id" id="jenis_surat_id" required>
                        <option value="">Pilih jenis layanan surat</option>
                        @foreach($jenisSurats as $item)
                            <option value="{{ $item->id }}" data-fields='{{ json_encode($item->fields_config ?? []) }}'>{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Dynamic fields container -->
                <div id="dynamic_fields_container" style="display: none;">
                    <!-- Fields will be injected here by JS -->
                </div>
                
                <div class="form-group">
                    <label>Keterangan Tambahan / Keperluan</label>
                    <textarea name="keterangan" placeholder="Contoh: Syarat Klaim BPJS, Pindah Domisili, dll."></textarea>
                </div>

                <div class="form-group">
                    <label>Upload Foto KTP (Wajib)</label>
                    <input type="file" name="foto_ktp" accept="image/*,application/pdf" required />
                    @error('foto_ktp')
                        <div style="color:#dc2626; font-size:0.8rem; margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>NIK KTP (Wajib, tanpa spasi)</label>
                    <input type="text" name="nik_ktp" maxlength="16" inputmode="numeric" placeholder="Contoh: 3201xxxxxxxxxx" required />
                    @error('nik_ktp')
                        <div style="color:#dc2626; font-size:0.8rem; margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Upload Foto KK (Wajib)</label>
                    <input type="file" name="foto_kk" accept="image/*,application/pdf" required />
                    @error('foto_kk')
                        <div style="color:#dc2626; font-size:0.8rem; margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>NIK KK (Wajib, tanpa spasi)</label>
                    <input
                        type="text"
                        name="nik_kk"
                        id="nik_kk_input"
                        maxlength="16"
                        inputmode="numeric"
                        placeholder="Contoh: 3201xxxxxxxxxx"
                        required
                    />
                    <div id="nik_kk_mismatch" style="display:none; color:#dc2626; font-size:0.8rem; margin-top:6px; font-weight:600;">NIK KK tidak sesuai dengan NIK KTP dari foto KK yang diupload. Pengajuan otomatis ditolak jika tidak cocok.</div>

                    @error('nik_kk')
                        <div style="color:#dc2626; font-size:0.8rem; margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>
                
                

                <div class="form-group">
                    <label>Surat Pengantar dari RT/RW (Wajib)</label>
                    <textarea name="surat_pengantar_rt_rw" required placeholder="Tulis/isi surat pengantar dari RT/RW (misal: No. surat, tanggal, dan keterangan singkat)">{{ old('surat_pengantar_rt_rw') }}</textarea>
                    @error('surat_pengantar_rt_rw')
                        <div style="color:#dc2626; font-size:0.8rem; margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nama Penandatangan</label>
                    <input type="text" name="nama_ttd" placeholder="Nama pejabat yang bertanda tangan" />
                </div>
                
                <div class="form-group">
                    <label>Jabatan Penandatangan</label>
                    <input type="text" name="jabatan_ttd" placeholder="Contoh: Kepala Desa, Sekretaris Desa" />
                </div>
                
                <button type="submit" class="btn-premium" style="width: 100%; margin-top: 6px;">
                    <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                    Kirim Berkas Pengajuan
                </button>
            </form>
        </div>

        <!-- Right Column: Tabel Data Pengajuan Master -->
        <div class="compact-box">
            <h3 class="box-title" style="margin-bottom: 12px;">
                <svg style="width:16px; height:16px; color:#475569;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                Daftar Antrean Pengajuan
            </h3>
            
            <div class="table-responsive-box" style="overflow-x: auto;">
                <table class="compact-table">
                    <thead>
                        <tr>
                            <th>Pemohon (Nama)</th>
                            <th>Jenis Surat</th>
                            <th style="width: 90px; text-align: center;">Status</th>
                            <th style="width: 150px; text-align: center;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengajuanSurats as $item)
                            <tr>
                                <td style="font-weight: 700; color: #0f172a;">{{ $item->penduduk->nama ?? '-' }}</td>
                                <td style="font-weight: 500;">{{ $item->jenisSurat->nama ?? '-' }}</td>
                                <td style="text-align: center;">
                                    @php $statusLower = Str::lower($item->status); @endphp
                                    <span class="status-badge-mini {{ $statusLower }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-stack" style="justify-content: center;">
                                        @if($statusLower === 'pending')
                                            <form method="POST" action="{{ route('pengajuan-surat.approve', $item) }}" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn-action-mini btn-approve-mini" title="Setujui Dokumen">Setuju</button>
                                            </form>
                                            <form method="POST" action="{{ route('pengajuan-surat.reject', $item) }}" style="display:inline;" onsubmit="return confirm('Tolak permohonan surat ini?')">
                                                @csrf
                                                <button type="submit" class="btn-action-mini btn-reject-mini" title="Tolak Dokumen">Tolak</button>
                                            </form>
                                            <form method="POST" action="{{ route('pengajuan-surat.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Hapus pengajuan surat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-mini btn-delete-mini" title="Hapus Pengajuan">Hapus</button>
                                            </form>
                                        @elseif($statusLower === 'ditolak')
                                            <form method="POST" action="{{ route('pengajuan-surat.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Hapus pengajuan surat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-mini btn-delete-mini" title="Hapus Pengajuan">Hapus</button>
                                            </form>
                                        @endif


                                        @if(!empty($item->nomor_surat))
                                            <a href="{{ route('pengajuan-surat.pdf', $item) }}" class="btn-action-mini btn-pdf-mini" style="display: inline-flex; align-items: center; gap: 3px;">
                                                <svg style="width:11px; height:11px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                Cetak
                                            </a>

                                            <form method="POST" action="{{ route('pengajuan-surat.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Hapus pengajuan surat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-mini btn-delete-mini" title="Hapus Pengajuan">Hapus</button>
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
                                    📭 Belum ada riwayat pengajuan surat masuk saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div style="margin-top: 14px; display: flex; justify-content: flex-end;">
                {{ $pengajuanSurats->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Async Search Script Modernized Layout -->
<script>
    (function () {
        const searchInput = document.getElementById('penduduk_search');
        const searchBtn = document.getElementById('penduduk_search_btn');
        const hiddenPendudukId = document.getElementById('penduduk_id');
        const suggestionsBox = document.getElementById('penduduk_suggestions');

        if (!searchInput || !searchBtn || !hiddenPendudukId || !suggestionsBox) return;

        const escapeHtml = (str) => {
            return String(str)
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        };

        const renderSuggestions = (items) => {
            suggestionsBox.innerHTML = '';

            if (!items || items.length === 0) {
                suggestionsBox.innerHTML = '<div style="color:#94a3b8; font-size:0.8rem; background:#fff; padding:8px 12px; border:1px solid #e2e8f0; border-radius:8px;">Tidak ada penduduk yang cocok.</div>';
                return;
            }

            const wrapper = document.createElement('div');
            wrapper.style.background = '#fff';
            wrapper.style.border = '1px solid #e2e8f0';
            wrapper.style.borderRadius = '8px';
            wrapper.style.overflow = 'hidden';
            wrapper.style.maxHeight = '200px';
            wrapper.style.overflowY = 'auto';
            wrapper.style.boxShadow = '0 4px 12px rgba(0,0,0,0.05)';

            items.forEach((item) => {
                const row = document.createElement('button');
                row.type = 'button';
                row.style.width = '100%';
                row.style.textAlign = 'left';
                row.style.padding = '8px 12px';
                row.style.border = 'none';
                row.style.background = 'transparent';
                row.style.cursor = 'pointer';
                row.style.display = 'block';

                const nama = item.nama ?? '-';
                const nik = item.nik ?? '-';

                row.innerHTML = '<div style="font-weight:700; color:#0f172a; font-size:0.82rem;">' + escapeHtml(nama) + '</div>' +
                    '<div style="color:#64748b; font-size:0.75rem;">' + escapeHtml(nik) + '</div>';

                row.addEventListener('click', () => {
                    hiddenPendudukId.value = item.id;
                    searchInput.value = nama + ' — ' + nik;
                    suggestionsBox.innerHTML = '';
                });

                row.addEventListener('mouseover', () => row.style.background = '#f8fafc');
                row.addEventListener('mouseout', () => row.style.background = 'transparent');

                wrapper.appendChild(row);
            });

            suggestionsBox.appendChild(wrapper);
        };

        const doSearch = async () => {
            const query = (searchInput.value || '').trim();

            if (query.length === 0) {
                hiddenPendudukId.value = '';
                suggestionsBox.innerHTML = '';
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
                suggestionsBox.innerHTML = '<div style="color:#dc2626; font-size:0.8rem;">Gagal mencari data penduduk.</div>';
            } finally {
                searchBtn.disabled = false;
                searchBtn.textContent = 'Cari';
            }
        };

        searchBtn.addEventListener('click', doSearch);
        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                doSearch();
            }
        });

        const form = document.querySelector('form[action="{{ route("pengajuan-surat.store") }}"]');

        const nikKtpInput = document.querySelector('input[name="nik_ktp"]');

                const nikKkInput = document.getElementById('nik_kk_input');
                const mismatchBox = document.getElementById('nik_kk_mismatch');

                const normalizeNik = (v) => String(v || '').replace(/\s+/g, '');

                const checkNikMatch = () => {
                    if (!nikKtpInput || !nikKkInput || !mismatchBox) return;
                    const nikKtp = normalizeNik(nikKtpInput.value);
                    const nikKk = normalizeNik(nikKkInput.value);

                    // only show mismatch when both have length 16 (digits:16)
                    // Tampilkan warning jika NIK KK tidak sama dengan NIK KTP.
                    // Agar sesuai permintaan: warning muncul ketika user sudah mengetik/mengubah input, bukan menunggu submit.
                    if (nikKtp.length === 16 && nikKk.length === 16 && nikKtp !== nikKk) {
                        mismatchBox.style.display = 'block';
                    } else {
                        mismatchBox.style.display = 'none';
                    }
                };

                if (nikKtpInput) nikKtpInput.addEventListener('input', checkNikMatch);
                if (nikKkInput) nikKkInput.addEventListener('input', checkNikMatch);

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
                        searchInput.value = (data[0].nama ?? '-') + ' — ' + (data[0].nik ?? '-');
                        form.submit();
                    } else {
                        alert('Nama/NIK penduduk tidak ditemukan. Pastikan memilih rekomendasi yang muncul.');
                    }
                } catch (err) {
                    alert('Gagal mengambil data penduduk untuk pengajuan.');
                }
            });
        }

        // ===== DYNAMIC FIELDS LOGIC =====
        const jenisSelect = document.getElementById('jenis_surat_id');
        const dynContainer = document.getElementById('dynamic_fields_container');

        if (jenisSelect && dynContainer) {
            const renderDynamicFields = () => {
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
                
                // Add a subtle divider
                const divider = document.createElement('div');
                divider.style.cssText = 'border-top: 1px dashed #cbd5e1; margin: 16px 0;';
                dynContainer.appendChild(divider);

                // Add section label
                const sectionLabel = document.createElement('div');
                sectionLabel.style.cssText = 'font-weight: 700; font-size: 0.78rem; color: #0f172a; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.3px;';
                sectionLabel.textContent = 'Data Khusus ' + (selected ? selected.text : '');
                dynContainer.appendChild(sectionLabel);

                let keluargaTableContainer = null;

                fields.forEach((field) => {
                    const fieldName = 'dynamic_' + field.name;
                    const requiredStar = field.required ? ' <span style="color:#dc2626;">*</span>' : '';

                    // Special handling for keluarga_pindah - render interactive table
                    if (field.name === 'keluarga_pindah') {
                        // Create hidden textarea to store JSON data
                        const hiddenInput = document.createElement('textarea');
                        hiddenInput.name = 'dynamic_keluarga_pindah';
                        hiddenInput.id = 'dynamic_keluarga_pindah';
                        hiddenInput.style.display = 'none';
                        hiddenInput.value = '[]';
                        dynContainer.appendChild(hiddenInput);

                        // Create interactive table
                        keluargaTableContainer = document.createElement('div');
                        keluargaTableContainer.className = 'form-group';
                        keluargaTableContainer.innerHTML = `
                            <label>ANGGOTA KELUARGA YANG PINDAH</label>
                            <div style="margin-bottom: 8px;">
                                <table style="width:100%; border-collapse: collapse; font-size: 0.82rem; border: 1px solid #e2e8f0;" id="keluarga_table">
                                    <thead>
                                        <tr style="background: #f8fafc;">
                                            <th style="padding: 6px; border: 1px solid #e2e8f0; text-align: center; width: 30px;">No</th>
                                            <th style="padding: 6px; border: 1px solid #e2e8f0; text-align: center;">NIK</th>
                                            <th style="padding: 6px; border: 1px solid #e2e8f0; text-align: center;">Nama Lengkap</th>
                                            <th style="padding: 6px; border: 1px solid #e2e8f0; text-align: center;">Tanggal Lahir</th>
                                            <th style="padding: 6px; border: 1px solid #e2e8f0; text-align: center;">SHDK</th>
                                            <th style="padding: 6px; border: 1px solid #e2e8f0; text-align: center; width: 40px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="keluarga_table_body">
                                        <tr>
                                            <td style="padding: 6px; border: 1px solid #e2e8f0; text-align: center;">1</td>
                                            <td style="padding: 6px; border: 1px solid #e2e8f0;"><input type="text" class="keluarga-input nik-input" placeholder="NIK" style="width:100%; border:1px solid #cbd5e1; border-radius:4px; padding:4px 6px; font-size:0.8rem;"></td>
                                            <td style="padding: 6px; border: 1px solid #e2e8f0;"><input type="text" class="keluarga-input nama-input" placeholder="Nama" style="width:100%; border:1px solid #cbd5e1; border-radius:4px; padding:4px 6px; font-size:0.8rem;"></td>
                                            <td style="padding: 6px; border: 1px solid #e2e8f0;"><input type="date" class="keluarga-input tgl-input" style="width:100%; border:1px solid #cbd5e1; border-radius:4px; padding:4px 6px; font-size:0.8rem;"></td>
                                            <td style="padding: 6px; border: 1px solid #e2e8f0;">
                                                <select class="keluarga-input shdk-input" style="width:100%; border:1px solid #cbd5e1; border-radius:4px; padding:4px 6px; font-size:0.8rem;">
                                                    <option value="">Pilih</option>
                                                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                                                    <option value="Istri">Istri</option>
                                                    <option value="Suami">Suami</option>
                                                    <option value="Anak">Anak</option>
                                                    <option value="Famili Lain">Famili Lain</option>
                                                </select>
                                            </td>
                                            <td style="padding: 6px; border: 1px solid #e2e8f0; text-align: center;">
                                                <button type="button" class="btn-remove-row" style="background:#fee2e2; color:#dc2626; border:none; border-radius:4px; padding:3px 8px; cursor:pointer; font-size:0.75rem; font-weight:700;">X</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" id="btn_add_keluarga" style="background:#f0fdf4; color:#16a34a; border:1px solid #bbf7d0; border-radius:6px; padding:5px 12px; cursor:pointer; font-size:0.78rem; font-weight:700;">+ Tambah Anggota</button>
                        `;
                        dynContainer.appendChild(keluargaTableContainer);
                        return;
                    }

                    // Skip hidden fields
                    if (field.type === 'hidden' || field.show === false) return;

                    const group = document.createElement('div');
                    group.className = 'form-group';

                    const label = document.createElement('label');
                    label.innerHTML = field.label + requiredStar;
                    group.appendChild(label);

                    if (field.type === 'textarea') {
                        const textarea = document.createElement('textarea');
                        textarea.name = fieldName;
                        textarea.placeholder = field.label;
                        if (field.required) textarea.required = true;
                        group.appendChild(textarea);
                    } else if (field.type === 'select' && field.options) {
                        const select = document.createElement('select');
                        select.name = fieldName;
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
                        if (field.required) input.required = true;
                        group.appendChild(input);
                    } else {
                        const input = document.createElement('input');
                        input.type = 'text';
                        input.name = fieldName;
                        input.placeholder = field.label;
                        if (field.required) input.required = true;
                        group.appendChild(input);
                    }

                    dynContainer.appendChild(group);
                });

                // Initialize keluarga table event handlers if it was rendered
                if (keluargaTableContainer) {
                    initKeluargaTable();
                }
            };

            // Function to sync table data to hidden textarea as JSON
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

            // Initialize keluarga table events
            function initKeluargaTable() {
                // Add row button
                const addBtn = document.getElementById('btn_add_keluarga');
                if (addBtn) {
                    addBtn.addEventListener('click', function() {
                        const tbody = document.getElementById('keluarga_table_body');
                        const rowCount = tbody.querySelectorAll('tr').length;
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td style="padding: 6px; border: 1px solid #e2e8f0; text-align: center;">${rowCount + 1}</td>
                            <td style="padding: 6px; border: 1px solid #e2e8f0;"><input type="text" class="keluarga-input nik-input" placeholder="NIK" style="width:100%; border:1px solid #cbd5e1; border-radius:4px; padding:4px 6px; font-size:0.8rem;"></td>
                            <td style="padding: 6px; border: 1px solid #e2e8f0;"><input type="text" class="keluarga-input nama-input" placeholder="Nama" style="width:100%; border:1px solid #cbd5e1; border-radius:4px; padding:4px 6px; font-size:0.8rem;"></td>
                            <td style="padding: 6px; border: 1px solid #e2e8f0;"><input type="date" class="keluarga-input tgl-input" style="width:100%; border:1px solid #cbd5e1; border-radius:4px; padding:4px 6px; font-size:0.8rem;"></td>
                            <td style="padding: 6px; border: 1px solid #e2e8f0;">
                                <select class="keluarga-input shdk-input" style="width:100%; border:1px solid #cbd5e1; border-radius:4px; padding:4px 6px; font-size:0.8rem;">
                                    <option value="">Pilih</option>
                                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                                    <option value="Istri">Istri</option>
                                    <option value="Suami">Suami</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Famili Lain">Famili Lain</option>
                                </select>
                            </td>
                            <td style="padding: 6px; border: 1px solid #e2e8f0; text-align: center;">
                                <button type="button" class="btn-remove-row" style="background:#fee2e2; color:#dc2626; border:none; border-radius:4px; padding:3px 8px; cursor:pointer; font-size:0.75rem; font-weight:700;">X</button>
                            </td>
                        `;
                        tbody.appendChild(newRow);
                        updateRowNumbers();
                        syncKeluargaData();
                    });
                }

                // Remove row (delegated)
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

                // Sync on input change (delegated)
                document.addEventListener('input', function(e) {
                    if (e.target.classList.contains('keluarga-input')) {
                        syncKeluargaData();
                    }
                });
                document.addEventListener('change', function(e) {
                    if (e.target.classList.contains('keluarga-input')) {
                        syncKeluargaData();
                    }
                });
            }

            function updateRowNumbers() {
                const rows = document.querySelectorAll('#keluarga_table_body tr');
                rows.forEach((row, idx) => {
                    const firstTd = row.querySelector('td:first-child');
                    if (firstTd) firstTd.textContent = idx + 1;
                });
            }

            jenisSelect.addEventListener('change', renderDynamicFields);
            
            // Initial render if a value was previously selected (on validation error)
            if (jenisSelect.value) {
                renderDynamicFields();
            }
        }
    })();
</script>
@endsection