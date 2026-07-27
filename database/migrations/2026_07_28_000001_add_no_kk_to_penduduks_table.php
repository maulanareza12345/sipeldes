<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            if (!Schema::hasColumn('penduduks', 'no_kk')) {
                $table->string('no_kk', 20)->nullable()->after('nik');
            }
            if (!Schema::hasColumn('penduduks', 'status_perkawinan')) {
                $table->string('status_perkawinan')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropColumn(['no_kk', 'status_perkawinan']);
        });
    }
};

