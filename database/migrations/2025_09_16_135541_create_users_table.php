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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('nim', 25)->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('email', 100)->unique();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('nomor_telepon', 15)->nullable();
            $table->unsignedInteger('jenis_pekerjaan_id')->nullable();
            $table->unsignedInteger('prodi_id')->nullable();
            $table->string('angkatan', 4)->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};


