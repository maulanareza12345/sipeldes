<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPelayanan extends Model
{
    protected $fillable = [
        'bulan',
        'tahun',
        'total_pengajuan',
        'total_disetujui',
        'total_ditolak',
    ];
}
