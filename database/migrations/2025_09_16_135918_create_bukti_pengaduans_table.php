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
            $table->unsignedInteger('pengaduan_id')->nullable();
            $table->string('file_path', 255)->nullable();
            $table->enum('jenis_bukti', ['Bukti Digital', 'Bukti Fisik', 'Bukti Lainnya'])->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_pengaduan');
    }
};
