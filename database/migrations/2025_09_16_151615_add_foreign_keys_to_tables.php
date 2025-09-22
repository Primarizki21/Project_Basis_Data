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
        // Add foreign keys to 'pengaduan' table
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('set null');
        });

        // Add foreign keys to 'bukti_pengaduan' table
        Schema::table('bukti_pengaduan', function (Blueprint $table) {
            $table->foreign('pengaduan_id')->references('pengaduan_id')->on('pengaduan')->onDelete('set null');
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('set null');
        });

        // Add foreign keys to 'tindak_lanjut' table
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->foreign('pengaduan_id')->references('pengaduan_id')->on('pengaduan')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus foreign key dari 'pengaduan'
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Hapus foreign key dari 'bukti_pengaduan'
        Schema::table('bukti_pengaduan', function (Blueprint $table) {
            $table->dropForeign(['pengaduan_id']);
            $table->dropForeign(['user_id']);
        });

        // Hapus foreign key dari 'tindak_lanjut'
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->dropForeign(['pengaduan_id']);
        });
    }
};
