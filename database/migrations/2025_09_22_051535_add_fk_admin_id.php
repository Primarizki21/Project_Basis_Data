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
        // tambahkan foreign key
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->foreign('admin_id')
                ->references('admin_id')
                ->on('admin')
                ->onDelete('set null'); // kalau admin dihapus, admin_id jadi NULL
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
        });

    }
};
