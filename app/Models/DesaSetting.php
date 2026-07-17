<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesaSetting extends Model
{
    protected $table = 'desa_settings';

    protected $fillable = [
        'nama_desa',
        'logo_path',
        'visi',
        'misi',
        'kop_alamat',
        'kop_kontak',
        'kop_email',
        'kop_kode_pos',
        'kop_logo_path',
        'template_surat_html',
    ];


    protected $casts = [
        'misi' => 'array',
    ];
}

