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
        Schema::table('reservasi', function (Blueprint $table) {
            $table->enum('status', ['OK', 'Dalam Antrian', 'Ditolak', 'Selesai'])->after('tipe_reservasi')->default('Dalam Antrian')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->enum('status', ['OK', 'Dalam Antrian', 'Ditolak'])->after('tipe_reservasi')->default('Dalam Antrian')->change();
        });
    }
};
