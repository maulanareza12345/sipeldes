# TODO: Sistem Pengarsipan & Manajemen Folder Surat

## Steps

### 1. ✅ Buat ArsipSuratController.php
- [x] Method `index()` - menampilkan arsip dengan filter & pencarian
- [x] Method `show()` - detail riwayat surat
- [x] Method `download()` - unduh PDF surat

### 2. ✅ Buat resources/views/arsip/index.blade.php
- [x] Tampilan folder-based per jenis surat
- [x] Filter bar (jenis surat, tanggal, nama pemohon)
- [x] Tabel daftar surat dengan aksi (Riwayat, Unduh, Lihat)

### 3. ✅ Buat resources/views/arsip/show.blade.php
- [x] Halaman detail riwayat surat

### 4. ✅ Edit routes/web.php
- [x] Tambah import ArsipSuratController
- [x] Tambah route arsip (index, show, download)

### 5. ✅ Edit resources/views/layouts/app.blade.php
- [x] Tambah menu "Arsip Surat" di sidebar
