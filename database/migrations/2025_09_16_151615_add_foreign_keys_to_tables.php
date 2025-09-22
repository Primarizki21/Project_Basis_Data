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
            $table->foreign('pelapor')->references('user_id')->on('user')->onDelete('cascade');
        });

        // Add foreign keys to 'bukti_pengaduan' table
        Schema::table('bukti_pengaduan', function (Blueprint $table) {
            $table->foreign('pengaduan_id')->references('pengaduan_id')->on('pengaduan')->onDelete('cascade');
            $table->foreign('uploaded_by')->references('user_id')->on('user')->onDelete('cascade');
        });

        // Add foreign keys to 'tindak_lanjut' table
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->foreign('pengaduan_id')->references('pengaduan_id')->on('pengaduan')->onDelete('cascade');
            $table->foreign('handled_by')->references('user_id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus foreign key dari 'pengaduan'
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropForeign(['pelapor']);
        });

        // Hapus foreign key dari 'bukti_pengaduan'
        Schema::table('bukti_pengaduan', function (Blueprint $table) {
            $table->dropForeign(['pengaduan_id']);
            $table->dropForeign(['uploaded_by']);
        });

        // Hapus foreign key dari 'tindak_lanjut'
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->dropForeign(['pengaduan_id']);
            $table->dropForeign(['handled_by']);
        });
    }
};
