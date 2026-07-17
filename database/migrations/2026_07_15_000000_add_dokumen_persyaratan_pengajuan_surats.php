<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            // Dokumen wajib
            $table->string('foto_ktp')->nullable()->after('user_id');
            $table->string('foto_kk')->nullable()->after('foto_ktp');

            // Input untuk validasi pencocokan otomatis (tanpa OCR)
            $table->string('nik_ktp', 16)->nullable()->after('foto_kk');
            $table->string('nik_kk', 16)->nullable()->after('nik_ktp');

            // Surat Pengantar dari RT/RW
            $table->text('surat_pengantar_rt_rw')->nullable()->after('keterangan');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $table->dropColumn([
                'foto_ktp',
                'foto_kk',
                'nik_ktp',
                'nik_kk',
                'surat_pengantar_rt_rw',
            ]);
        });
    }
};

