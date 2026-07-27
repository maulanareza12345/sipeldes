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
            $table->json('fields_config')->nullable()->after('deskripsi');
            $table->string('pdf_template', 100)->nullable()->after('fields_config');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jenis_surats', function (Blueprint $table) {
            $table->dropColumn(['fields_config', 'pdf_template']);
        });
    }
};
