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
        Schema::table('members', function (Blueprint $table) {
            $table->string('nomor_anggota')->unique()->nullable()->after('id');
        });

        // Backfill existing members
        $members = \App\Models\Member::orderBy('id', 'asc')->get();
        foreach ($members as $member) {
            if (!$member->nomor_anggota) {
                // Generate a simple DAH-YEAR-ID for existing members
                $tahun = $member->created_at ? $member->created_at->format('Y') : date('Y');
                $member->nomor_anggota = 'DAH-' . $tahun . '-' . str_pad($member->id, 4, '0', STR_PAD_LEFT);
                $member->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('nomor_anggota');
        });
    }
};
