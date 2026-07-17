# TODO - Landing Page Restructure & Hapus /desa/profile

## Status saat ini
- `resources/views/welcome.blade.php` sudah diubah menjadi landing page sebelum login (profil singkat, fitur layanan, struktur organisasi, lokasi + embed Google Maps).
- Navbar landing sudah berisi scroll link ke bagian **Fitur-Fitur**.
- Routing `GET/POST /desa/profile` sudah dihapus dari `routes/web.php`.
- Menu sidebar `Profil Desa` sudah dihapus dari `resources/views/layouts/app.blade.php`.

## Langkah tersisa
1. Hapus file view `resources/views/desa/profile.blade.php`.
2. Hapus controller `app/Http/Controllers/DesaProfileController.php`.
3. Jalankan `php artisan route:list` untuk memastikan tidak ada route /desa/profile.
4. Jalankan quick check di browser:
   - Buka `/` dan verifikasi section + scroll.
   - Login dan verifikasi sidebar tidak memuat Profil Desa.

