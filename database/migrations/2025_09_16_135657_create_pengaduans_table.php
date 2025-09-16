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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->increments('pengaduan_id');
            $table->unsignedInteger('pelapor');
            $table->string('kategori_kekerasan_id', 50)->nullable();
            $table->text('deskripsi_kejadian');
            $table->date('tanggal_kejadian');
            $table->date('tanggal_melapor');
            $table->enum('status_pengaduan', ['Diproses', 'Selesai', 'Menunggu']);
            $table->enum('status_pelapor', ['Korban', 'Keluarga', 'Teman', 'Saksi']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
