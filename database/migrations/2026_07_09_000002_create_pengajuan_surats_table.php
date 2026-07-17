<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_surats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penduduk_id');
            $table->unsignedBigInteger('jenis_surat_id');
            $table->unsignedBigInteger('user_id');
            $table->text('keterangan')->nullable();
            $table->string('status')->default('pending');
            $table->date('tanggal_pengajuan')->nullable();
            $table->date('tanggal_disetujui')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();

            $table->foreign('penduduk_id')->references('id')->on('penduduks')->cascadeOnDelete();
            $table->foreign('jenis_surat_id')->references('id')->on('jenis_surats')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surats');
    }
};
