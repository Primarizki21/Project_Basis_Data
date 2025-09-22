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
        Schema::create('tindak_lanjut', function (Blueprint $table) {
            $table->increments('tindak_lanjut_id');
            $table->string('jenis_tindak_lanjut', 30)->nullable();
            $table->text('deskripsi');
            $table->unsignedInteger('pengaduan_id')->nullable();
            $table->unsignedInteger('handled_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjut');
    }
};
