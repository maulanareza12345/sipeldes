<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanTtdBulanan extends Model
{
    protected $table = 'laporan_ttd_bulanan';

    protected $fillable = [
        'bulan',
        'tahun',
        'nama_ttd',
        'jabatan_ttd',
    ];
}

