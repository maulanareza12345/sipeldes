<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    protected $fillable = [
        'penduduk_id',
        'jenis_surat_id',
        'user_id',

        'keterangan',
        'surat_pengantar_rt_rw',

        // Dokumen wajib
        'foto_ktp',
        'foto_kk',
        
        // Input untuk validasi otomatis (tanpa OCR)
        'nik_ktp',
        'nik_kk',

        // ttd (diisi dari form Ajukan Surat Baru)
        'jabatan_ttd',
        'nama_ttd',

        'status',
        'tanggal_pengajuan',
        'tanggal_disetujui',
        'nomor_surat',
        'catatan_admin',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
