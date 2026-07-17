<?php

namespace Database\Seeders;

use App\Models\DesaSetting;
use Illuminate\Database\Seeder;

class DesaSettingSeeder extends Seeder
{
    public function run(): void
    {
        // Force seed untuk memastikan visi/misi tidak kosong saat data lama sudah ada.
        if (! DesaSetting::query()->exists()) {
            DesaSetting::create([
                'nama_desa' => 'Desa Bojongloa',
                'logo_path' => null,
                'visi' => 'Terwujudnya masyarakat Desa Bojongloa yang Bersih, Religius, Sejahtera, Rapi dan Indah melalui Akselerasi Pembangunan yang berbasis Keagamaan, Budaya Hukum dan Berwawasan Lingkungan dengan berorientasi pada peningkatan Kinerja Aparatur dan Pemberdayaan Masyarakat',
                'misi' => [
                    'Pembangunan Jangka Panjang: Melanjutkan pembangunan desa yang belum terlaksana.',
                    'Pembangunan Jangka Panjang: Meningkatkan kerjasama antara pemerintah desa dengan lembaga desa yang ada.',
                    'Pembangunan Jangka Panjang: Meningkatkan kesejahteraan masyarakat desa dengan meningkatkan sarana dan prasarana ekonomi warga.',
                    'Pembangunan Jangka Pendek: Mengembangkan serta menjaga dan melestarikan adat istiadat desa yang telah mengakar di desa Bojongloa.',
                    'Pembangunan Jangka Pendek: Meningkatkan pelayanan dalam bidang pemerintahan kepada warga masyarakat.',
                    'Pembangunan Jangka Pendek: Meningkatkan sarana dan prasarana ekonomi warga desa dengan perbaikan prasarana dan sarana ekonomi.',
                    'Pembangunan Jangka Pendek: Meningkatkan sarana dan prasarana pendidikan guna peningkatan sumber daya manusia Desa Bojongloa.',
                ],
                'kop_alamat' => 'TODO: Alamat kantor desa',
                'kop_kontak' => 'TODO: Kontak desa',
                'kop_logo_path' => null,
                'template_surat_html' => null,
            ]);
        }
    }
}


