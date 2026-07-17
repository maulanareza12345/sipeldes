<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Sesuaikan dengan skema tabel users pada database kamu:
        // - migration aplikasi: id, name, email, password, role
        // - beberapa dataset XAMPP: bisa jadi berbeda, tapi di sini kita gunakan migration yang sudah dipakai saat migrate.
        User::firstOrCreate(
            ['email' => 'admin@desa.test'],
            [
                'name' => 'Admin Desa',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'perangkat@desa.test'],
            [
                'name' => 'Perangkat Desa',
                'password' => Hash::make('password'),
                'role' => 'perangkat',
            ]
        );


        Penduduk::firstOrCreate(
            ['nik' => '3201010101010001'],
            [
                'nama' => 'Budi Santoso',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Raya Bojongloa',
                'pekerjaan' => 'Petani',
            ]
        );

        Penduduk::firstOrCreate(
            ['nik' => '3201010101010002'],
            [
                'nama' => 'Siti Aminah',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1992-04-20',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Cikapundung',
                'pekerjaan' => 'Guru',
            ]
        );


        // Jenis surat (12 layanan) - gunakan cukup sekali saja (tidak menambah jika sudah ada)
        $jenisSurats = [
            ['nama' => 'Surat Keterangan Domisili', 'deskripsi' => 'Untuk keperluan domisili'],
            ['nama' => 'Surat Pengantar KTP', 'deskripsi' => 'Untuk pengurusan/penertiban dokumen KTP'],
            ['nama' => 'Surat Pengantar KK', 'deskripsi' => 'Untuk pengurusan/penertiban dokumen KK'],
            ['nama' => 'Surat Keterangan Usaha', 'deskripsi' => 'Untuk usaha kecil'],
            ['nama' => 'Surat Keterangan Tidak Mampu', 'deskripsi' => 'Untuk bantuan sosial'],
            ['nama' => 'Surat Keterangan Kelahiran', 'deskripsi' => 'Untuk pencatatan kelahiran'],
            ['nama' => 'Surat Keterangan Kematian', 'deskripsi' => 'Untuk pencatatan kematian'],
            ['nama' => 'Surat Pindah', 'deskripsi' => 'Untuk administrasi perpindahan'],
            ['nama' => 'Surat Kehilangan', 'deskripsi' => 'Untuk keperluan kehilangan'],
            ['nama' => 'Surat Izin Keramaian', 'deskripsi' => 'Untuk izin kegiatan/keramaian'],
            ['nama' => 'Surat Pengantar Nikah', 'deskripsi' => 'Untuk pengurusan surat nikah'],
            ['nama' => 'Surat Ahli Waris', 'deskripsi' => 'Untuk pengurusan ahli waris'],
            ['nama' => 'Surat Bebas Sengketa', 'deskripsi' => 'Untuk pernyataan bebas sengketa'],
        ];

        foreach ($jenisSurats as $item) {
            JenisSurat::firstOrCreate([
                'nama' => $item['nama'],
            ], [
                'deskripsi' => $item['deskripsi'],
            ]);
        }


        // seed profil desa (logo, visi misi, kop surat)
        $this->call(\Database\Seeders\DesaSettingSeeder::class);
    }
}

