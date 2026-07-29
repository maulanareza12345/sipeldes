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
        Schema::table('jenis_surats', function (Blueprint $table) {
            $table->enum('surat_pengantar', ['wajib', 'opsional', 'tidak_perlu'])
                ->default('wajib')
                ->after('pdf_template')
                ->comment('Aturan lampiran Surat Pengantar RT/RW');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jenis_surats', function (Blueprint $table) {
            $table->dropColumn('surat_pengantar');
        });
    }
};

