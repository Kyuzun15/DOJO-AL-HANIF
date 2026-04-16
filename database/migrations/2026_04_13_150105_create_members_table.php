<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('berat_badan');
            $table->integer('tinggi_badan');
            $table->string('nama_ayah');
            $table->string('no_hp_ayah');
            $table->string('nama_ibu');
            $table->string('no_hp_ibu');
            $table->text('alamat');

            $table->string('sabuk')->default('Belum punya sabuk');
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->timestamp('tanggal_diterima');
            $table->timestamp('tanggal_dinonaktifkan')->nullable(); // Kolom baru
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
