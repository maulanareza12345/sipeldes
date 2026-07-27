<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $fillable = [
        'no_kk',
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'pekerjaan',
        'kewarganegaraan',
        'status',
        'status_perkawinan',
        'agama',
        'foto',
    ];
}
