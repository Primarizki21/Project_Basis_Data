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
        Schema::create('kategori_kekerasan', function (Blueprint $table) {
            $table->increments('kategori_kekerasan_id'); // primary key
            $table->string('jenis_kekerasan', 50); // pilihan yang tampil di form
            $table->string('deskripsi_kekerasan', 100)->nullable(); // deskripsi singkat
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_kekerasan');
    }
};
