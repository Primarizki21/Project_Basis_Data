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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->increments('pengaduan_id');
            $table->unsignedInteger('pelapor')->nullable();
            $table->string('kategori_kekerasan', 50)->nullable();
            $table->text('deskripsi_kejadian');
            $table->date('tanggal_kejadian')->nullable();
            $table->enum('status_pengaduan', ['Diproses', 'Selesai', 'Menunggu'])->nullable();
            $table->enum('status_pelapor', ['Korban', 'Keluarga', 'Teman', 'Saksi'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
