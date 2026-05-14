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
        Schema::table('penguruses', function (Blueprint $table) {
            $table->dropUnique('penguruses_kode_jabatan_unique');
            $table->string('sub_jabatan')->nullable()->after('kode_jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penguruses', function (Blueprint $table) {
            $table->unique('kode_jabatan', 'penguruses_kode_jabatan_unique');
            $table->dropColumn('sub_jabatan');
        });
    }
};
