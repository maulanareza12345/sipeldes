<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'fields_config', 'pdf_template', 'surat_pengantar'];

    protected $casts = [
        'fields_config' => 'array',
    ];
}
