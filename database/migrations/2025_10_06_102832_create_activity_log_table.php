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
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('user_id') // kolom PK di tabel user
                ->on('user')            // nama tabel user
                ->nullOnDelete(); 
        
            $table->string('description'); 
            // Ini bagian Polymorphic: subject_id & subject_type
            // subject_id akan menyimpan ID dari User/Pengaduan
            // subject_type akan menyimpan nama modelnya (e.g., 'App\Models\User')
            $table->morphs('subject'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_log');
    }
};
