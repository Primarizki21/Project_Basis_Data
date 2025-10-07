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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('jenis_pekerjaan_id')
                  ->references('jenis_pekerjaan_id')
                  ->on('jenis_pekerjaan')
                  ->onDelete('set null');
        });
        
        Schema::table('admin', function (Blueprint $table) {
            $table->foreign('jenis_pekerjaan_id')
                ->references('jenis_pekerjaan_id')
                ->on('jenis_pekerjaan')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['jenis_pekerjaan_id']);            
        });
        Schema::table('admin', function (Blueprint $table) {
            $table->dropForeign(['jenis_pekerjaan_id']);
        });
    }
};