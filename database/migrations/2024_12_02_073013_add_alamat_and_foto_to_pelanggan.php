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
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->string('alamat', 255)->after('no_hp'); //Menambahkan kolom alamat
            $table->string('foto_profil')->after('alamat')->nullable(); //Menambahkan kolom foto profil
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->dropColumn(['alamat', 'foto_profil']); //Menghapus kolom alamat dan foto profil
        });
    }
};
