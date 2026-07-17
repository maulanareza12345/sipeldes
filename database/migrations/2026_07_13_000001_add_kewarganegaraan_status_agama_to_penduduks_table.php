<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            // Pastikan kolom hanya dibuat jika belum ada (menghindari error saat migrasi terulang)
            if (!Schema::hasColumn('penduduks', 'kewarganegaraan')) {
                $table->string('kewarganegaraan')->nullable();
            }
            if (!Schema::hasColumn('penduduks', 'status')) {
                $table->string('status')->nullable();
            }
            if (!Schema::hasColumn('penduduks', 'agama')) {
                $table->string('agama')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropColumn(['kewarganegaraan', 'status', 'agama']);
        });
    }
};

