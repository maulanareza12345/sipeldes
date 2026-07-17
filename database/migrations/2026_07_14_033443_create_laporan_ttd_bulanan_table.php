<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_ttd_bulanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('bulan'); // 1-12
            $table->unsignedSmallInteger('tahun');

            $table->string('nama_ttd', 255);
            $table->string('jabatan_ttd', 255);

            $table->timestamps();

            $table->unique(['bulan', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_ttd_bulanan');
    }
};

