<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            // hapus kolom lama string kategori_kekerasan
            $table->dropColumn('kategori_kekerasan');

            // tambahkan kolom baru untuk foreign key
            $table->unsignedInteger('kategori_kekerasan_id')->nullable()->after('pengaduan_id');

            // set foreign key constraint
            $table->foreign('kategori_kekerasan_id')
                  ->references('kategori_kekerasan_id')
                  ->on('kategori_kekerasan')
                  ->onDelete('set null'); 
                  // kalau data kategori dihapus, nilai FK di pengaduan jadi null
        });
    }

    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            // rollback: hapus fk & kolom baru
            $table->dropForeign(['kategori_kekerasan_id']);
            $table->dropColumn('kategori_kekerasan_id');

            // kembalikan kolom lama string
            $table->string('kategori_kekerasan', 50)->nullable();
        });
    }
};
