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
        Schema::create('kategori_komplain', function (Blueprint $table) {
            $table->increments('kategori_komplain_id'); // primary key
            $table->string('jenis_komplain', 50); // pilihan yang tampil di form
            $table->string('deskripsi_komplain', 100)->nullable(); // deskripsi singkat
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_komplain');
    }
};
