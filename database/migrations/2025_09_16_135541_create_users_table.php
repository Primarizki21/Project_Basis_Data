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
        Schema::create('user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('nim', 25)->nullable();
            $table->string('nama', 100)->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan', 'Lainnya'])->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('nomor_telepon', 15)->nullable();
            $table->string('pekerjaan', 50)->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};


