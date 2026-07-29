# ✅ SELESAI: Remove Demografi Penduduk & Statistik Pengajuan Bulanan from Dashboard

## Completed Tasks

### 1. `app/Http/Controllers/DashboardController.php` ✅
- [x] Hapus query `pendudukByGender`, `pendudukByAgama`, `pendudukByStatus`, `pendudukByPekerjaan`
- [x] Hapus query `jenisKelahiran`, `jenisKematian`, `jenisPindah`
- [x] Hapus query `monthlyKelahiran`, `monthlyKematian`, `monthlyPindah`
- [x] Hapus helper method `getMonthlyCountByJenis()`
- [x] Update `compact()` — hanya dengan `totalPenduduk`, `totalPengajuan`, `disetujui`, `pending`, `ditolak`, `recent`

### 2. `resources/views/dashboard/index.blade.php` ✅
- [x] Hapus section HTML Demografi Penduduk (chart-grid-4 dengan 4 chart card)
- [x] Hapus section HTML Statistik Pengajuan Bulanan (chart-grid-3 dengan 3 chart card)
- [x] Hapus CSS class chart-grid-4, chart-grid-3, chart-card, chart-card-title, chart-wrapper
- [x] Hapus JavaScript chart demografi (genderChart, agamaChart, statusChart, pekerjaanChart)
- [x] Hapus JavaScript chart bulanan (renderMonthlyChart function + 3 pemanggilan)
- [x] Hapus duplikasi `</style>`
- [x] Hanya menyisakan chart statusPie (Rasio Berkas) — masih berfungsi normal

