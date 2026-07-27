<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use Illuminate\Database\Seeder;

class JenisSuratConfigSeeder extends Seeder
{
    public function run(): void
    {
        $configs = [
            'Surat Keterangan Domisili' => [
                'fields_config' => [
                    ['name' => 'nama_usaha', 'label' => 'Nama Usaha (jika ada)', 'type' => 'text', 'required' => false, 'show' => true],
                    ['name' => 'alamat_domisili', 'label' => 'Alamat Domisili', 'type' => 'textarea', 'required' => true, 'show' => true],
                    ['name' => 'keperluan', 'label' => 'Keperluan Domisili', 'type' => 'textarea', 'required' => true, 'show' => true],
                    ['name' => 'lama_tinggal', 'label' => 'Lama Tinggal', 'type' => 'text', 'required' => false, 'show' => true],
                ],
                'pdf_template' => 'domisili',
            ],
            'Surat Pengantar KTP' => [
                'fields_config' => [
                    ['name' => 'keperluan_ktp', 'label' => 'Keperluan KTP', 'type' => 'textarea', 'required' => true, 'show' => true],
                ],
                'pdf_template' => 'pengantar-ktp',
            ],
            'Surat Pengantar KK' => [
                'fields_config' => [
                    ['name' => 'keperluan_kk', 'label' => 'Keperluan KK', 'type' => 'textarea', 'required' => true, 'show' => true],
                ],
                'pdf_template' => 'pengantar-kk',
            ],
            'Surat Keterangan Usaha' => [
                'fields_config' => [
                    ['name' => 'nama_usaha', 'label' => 'Nama Usaha', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'jenis_usaha', 'label' => 'Jenis Usaha', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'alamat_usaha', 'label' => 'Alamat Usaha', 'type' => 'textarea', 'required' => true, 'show' => true],
                    ['name' => 'modal_usaha', 'label' => 'Modal Usaha (Rp)', 'type' => 'text', 'required' => false, 'show' => true],
                    ['name' => 'keperluan', 'label' => 'Keperluan', 'type' => 'textarea', 'required' => true, 'show' => true],
                ],
                'pdf_template' => 'usaha',
            ],
            'Surat Keterangan Tidak Mampu' => [
                'fields_config' => [
                    ['name' => 'penghasilan', 'label' => 'Penghasilan per Bulan (Rp)', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'tanggungan', 'label' => 'Jumlah Tanggungan', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'keperluan', 'label' => 'Keperluan Surat Tidak Mampu', 'type' => 'textarea', 'required' => true, 'show' => true],
                    ['name' => 'keterangan_tambahan', 'label' => 'Keterangan Tambahan', 'type' => 'textarea', 'required' => false, 'show' => true],
                ],
                'pdf_template' => 'tidak-mampu',
            ],
            'Surat Keterangan Kelahiran' => [
                'fields_config' => [
                    ['name' => 'nama_bayi', 'label' => 'Nama Bayi', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'tempat_lahir_bayi', 'label' => 'Tempat Lahir Bayi', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'tanggal_lahir_bayi', 'label' => 'Tanggal Lahir Bayi', 'type' => 'date', 'required' => true, 'show' => true],
                    ['name' => 'jenis_kelamin_bayi', 'label' => 'Jenis Kelamin Bayi', 'type' => 'select', 'required' => true, 'show' => true, 'options' => ['Laki-laki', 'Perempuan']],
                    ['name' => 'nama_ayah', 'label' => 'Nama Ayah', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'nama_ibu', 'label' => 'Nama Ibu', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'anak_ke', 'label' => 'Anak Ke-', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'keperluan', 'label' => 'Keperluan', 'type' => 'textarea', 'required' => false, 'show' => true],
                ],
                'pdf_template' => 'kelahiran',
            ],
            'Surat Keterangan Kematian' => [
                'fields_config' => [
                    ['name' => 'tanggal_kematian', 'label' => 'Tanggal Kematian', 'type' => 'date', 'required' => true, 'show' => true],
                    ['name' => 'tempat_kematian', 'label' => 'Tempat Kematian', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'penyebab_kematian', 'label' => 'Penyebab Kematian', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'nama_ahli_waris', 'label' => 'Nama Ahli Waris', 'type' => 'text', 'required' => false, 'show' => true],
                    ['name' => 'keperluan', 'label' => 'Keperluan', 'type' => 'textarea', 'required' => false, 'show' => true],
                ],
                'pdf_template' => 'kematian',
            ],
            'Surat Pindah' => [
                'fields_config' => [
                    ['name' => 'no_kk', 'label' => 'No. KK', 'type' => 'text', 'required' => false, 'show' => true],
                    ['name' => 'nik', 'label' => 'NIK', 'type' => 'text', 'required' => false, 'show' => true],
                    ['name' => 'nama', 'label' => 'Nama', 'type' => 'text', 'required' => false, 'show' => true],
                    ['name' => 'jenis_kelamin', 'label' => 'Jenis Kelamin', 'type' => 'select', 'required' => false, 'show' => true, 'options' => ['Laki-laki', 'Perempuan']],
                    ['name' => 'tempat_lahir', 'label' => 'Tempat Lahir', 'type' => 'text', 'required' => false, 'show' => true],
                    ['name' => 'tanggal_lahir', 'label' => 'Tanggal Lahir', 'type' => 'date', 'required' => false, 'show' => true],
                    ['name' => 'kewarganegaraan', 'label' => 'Kewarganegaraan', 'type' => 'text', 'required' => false, 'show' => true],
                    ['name' => 'agama', 'label' => 'Agama', 'type' => 'select', 'required' => false, 'show' => true, 'options' => ['Islam', 'Kristen', 'Katholik', 'Hindu', 'Budha', 'Khonghucu']],
                    ['name' => 'pekerjaan', 'label' => 'Pekerjaan', 'type' => 'text', 'required' => false, 'show' => true],
                    ['name' => 'status_perkawinan', 'label' => 'Status Perkawinan', 'type' => 'select', 'required' => false, 'show' => true, 'options' => ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']],
                    ['name' => 'alamat_asal', 'label' => 'Alamat Asal', 'type' => 'textarea', 'required' => false, 'show' => true],
                    ['name' => 'alamat_tujuan', 'label' => 'Alamat Tujuan Pindah', 'type' => 'textarea', 'required' => true, 'show' => true],
                    ['name' => 'rt_tujuan', 'label' => 'RT Tujuan', 'type' => 'text', 'required' => false, 'show' => true],
                    ['name' => 'rw_tujuan', 'label' => 'RW Tujuan', 'type' => 'text', 'required' => false, 'show' => true],
                    ['name' => 'desa_tujuan', 'label' => 'Desa/Kelurahan Tujuan', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'kecamatan_tujuan', 'label' => 'Kecamatan Tujuan', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'kabupaten_tujuan', 'label' => 'Kab/Kota Tujuan', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'provinsi_tujuan', 'label' => 'Provinsi Tujuan', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'tanggal_pindah', 'label' => 'Tanggal Pindah', 'type' => 'date', 'required' => true, 'show' => true],
                    ['name' => 'alasan_pindah', 'label' => 'Alasan Pindah', 'type' => 'textarea', 'required' => true, 'show' => true],
                    ['name' => 'jumlah_keluarga', 'label' => 'Jumlah Keluarga yg Pindah', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'keluarga_pindah', 'label' => 'Anggota Keluarga Pindah', 'type' => 'textarea', 'required' => false, 'show' => false],
                    ['name' => 'keluarga_pindah_json', 'label' => 'Data Keluarga Pindah (JSON)', 'type' => 'hidden', 'required' => false, 'show' => false],
                ],
                'pdf_template' => 'pindah',
            ],
            'Surat Kehilangan' => [
                'fields_config' => [
                    ['name' => 'jenis_barang', 'label' => 'Jenis Barang yg Hilang', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'ciri_barang', 'label' => 'Ciri-ciri Barang', 'type' => 'textarea', 'required' => true, 'show' => true],
                    ['name' => 'tanggal_kehilangan', 'label' => 'Tanggal Kehilangan', 'type' => 'date', 'required' => true, 'show' => true],
                    ['name' => 'lokasi_kehilangan', 'label' => 'Lokasi Kehilangan', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'nilai_barang', 'label' => 'Nilai Barang (Rp)', 'type' => 'text', 'required' => false, 'show' => true],
                    ['name' => 'keperluan', 'label' => 'Keperluan', 'type' => 'textarea', 'required' => true, 'show' => true],
                ],
                'pdf_template' => 'kehilangan',
            ],
            'Surat Izin Keramaian' => [
                'fields_config' => [
                    ['name' => 'jenis_acara', 'label' => 'Jenis Acara/Kegiatan', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'tanggal_acara', 'label' => 'Tanggal Acara', 'type' => 'date', 'required' => true, 'show' => true],
                    ['name' => 'waktu_acara', 'label' => 'Waktu Acara', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'lokasi_acara', 'label' => 'Lokasi Acara', 'type' => 'textarea', 'required' => true, 'show' => true],
                    ['name' => 'jumlah_peserta', 'label' => 'Jumlah Peserta', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'penanggung_jawab', 'label' => 'Penanggung Jawab', 'type' => 'text', 'required' => true, 'show' => true],
                ],
                'pdf_template' => 'izin-keramaian',
            ],
            'Surat Pengantar Nikah' => [
                'fields_config' => [
                    ['name' => 'nama_calon_suami', 'label' => 'Nama Calon Suami', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'nik_calon_suami', 'label' => 'NIK Calon Suami', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'nama_calon_istri', 'label' => 'Nama Calon Istri', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'nik_calon_istri', 'label' => 'NIK Calon Istri', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'tanggal_nikah', 'label' => 'Tanggal Nikah', 'type' => 'date', 'required' => true, 'show' => true],
                    ['name' => 'mas_kawin', 'label' => 'Mas Kawin', 'type' => 'text', 'required' => false, 'show' => true],
                    ['name' => 'keperluan', 'label' => 'Keperluan', 'type' => 'textarea', 'required' => false, 'show' => true],
                ],
                'pdf_template' => 'pengantar-nikah',
            ],
            'Surat Ahli Waris' => [
                'fields_config' => [
                    ['name' => 'nama_pewaris', 'label' => 'Nama Pewaris (Almarhum)', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'nik_pewaris', 'label' => 'NIK Pewaris', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'tanggal_meninggal', 'label' => 'Tanggal Meninggal', 'type' => 'date', 'required' => true, 'show' => true],
                    ['name' => 'tempat_meninggal', 'label' => 'Tempat Meninggal', 'type' => 'text', 'required' => true, 'show' => true],
                    ['name' => 'daftar_ahli_waris', 'label' => 'Daftar Ahli Waris (Nama & Hubungan)', 'type' => 'textarea', 'required' => true, 'show' => true],
                    ['name' => 'harta_waris', 'label' => 'Harta Waris (jika ada)', 'type' => 'textarea', 'required' => false, 'show' => true],
                    ['name' => 'keperluan', 'label' => 'Keperluan', 'type' => 'textarea', 'required' => true, 'show' => true],
                ],
                'pdf_template' => 'ahli-waris',
            ],
            'Surat Bebas Sengketa' => [
                'fields_config' => [
                    ['name' => 'objek_sengketa', 'label' => 'Objek yang Dinyatakan Bebas Sengketa', 'type' => 'textarea', 'required' => true, 'show' => true],
                    ['name' => 'lokasi_objek', 'label' => 'Lokasi Objek', 'type' => 'textarea', 'required' => true, 'show' => true],
                    ['name' => 'pernyataan_tambahan', 'label' => 'Pernyataan Tambahan', 'type' => 'textarea', 'required' => false, 'show' => true],
                    ['name' => 'keperluan', 'label' => 'Keperluan', 'type' => 'textarea', 'required' => true, 'show' => true],
                ],
                'pdf_template' => 'bebas-sengketa',
            ],
        ];

        foreach ($configs as $nama => $config) {
            $jenisSurat = JenisSurat::where('nama', $nama)->first();
            if ($jenisSurat) {
                $jenisSurat->update([
                    'fields_config' => $config['fields_config'],
                    'pdf_template' => $config['pdf_template'],
                ]);
                $this->command->info("Updated: {$nama}");
            } else {
                $this->command->warn("Jenis surat '{$nama}' tidak ditemukan, skip.");
            }
        }
    }
}

