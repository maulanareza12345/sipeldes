# TODO: Fitur Format Nomor Surat Otomatis

## Step 1: Controller - Tambah mapping format nomor surat & pass ke view
- [x] Tambah array format nomor surat di `PengajuanSuratController` (11 format + fallback)
- [x] Helper function `getNomorFormatFor($jenisSuratNama)`
- [x] `index()`: pass `$nomorSuratFormats` ke view
- [x] `approve()`: generate nomor surat sesuai format per jenis surat
- [x] `pdf()`: fallback nomor_surat juga pakai format sesuai jenis surat

## Step 2: View - Tampilkan format nomor surat di dropdown
- [x] `index.blade.php`: tambah atribut `data-nomor-format` pada tiap `<option>`
- [x] `index.blade.php`: tambah elemen "Format Nomor Surat" di surat-info-card
- [x] JS: saat pilih jenis surat, tampilkan format nomor otomatis
