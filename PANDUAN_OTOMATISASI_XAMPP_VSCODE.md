# Panduan Otomatisasi XAMPP dan VS Code

## 1. Prasyarat
- Install XAMPP atau Laragon
- Install VS Code
- Install PHP 8.3 dan Composer

## 2. Jalankan proyek
1. Buka folder proyek di VS Code.
2. Jalankan task "Start Laravel App" dari Command Palette.
3. Buka http://127.0.0.1:8000.

## 3. Jalankan migrasi dan seeder
```bash
php artisan migrate --seed
```

## 4. Login demo
- Admin: admin@desa.test / password
- Perangkat: perangkat@desa.test / password
