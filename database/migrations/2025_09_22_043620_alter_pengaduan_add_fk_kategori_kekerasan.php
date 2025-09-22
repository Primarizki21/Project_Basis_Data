<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->foreign('kategori_komplain_id')->references('kategori_komplain_id')->on('kategori_komplain')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            // rollback: hapus fk & kolom baru
            $table->dropForeign(['kategori_komplain_id']);
        });
    }
};
