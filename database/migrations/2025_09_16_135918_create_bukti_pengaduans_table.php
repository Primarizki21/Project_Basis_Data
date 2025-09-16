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
        Schema::create('bukti_pengaduan', function (Blueprint $table) {
            $table->increments('bukti_pengaduan_id');
            $table->unsignedInteger('pengaduan_id');
            $table->string('file_path', 255);
            $table->enum('jenis_bukti', ['Bukti Digital', 'Bukti Fisik', 'Bukti Lainnya']);
            $table->date('tanggal_upload_bukti');
            $table->unsignedInteger('uploaded_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_pengaduans');
    }
};
