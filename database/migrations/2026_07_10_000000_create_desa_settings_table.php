<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('desa_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa')->nullable();
            $table->string('logo_path')->nullable();
            $table->text('visi')->nullable();
            $table->json('misi')->nullable();
            $table->text('kop_alamat')->nullable();
            $table->text('kop_kontak')->nullable();
            $table->string('kop_email')->nullable();
            $table->string('kop_kode_pos')->nullable();
            $table->string('kop_logo_path')->nullable();
            $table->longText('template_surat_html')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('desa_settings');
    }
};

