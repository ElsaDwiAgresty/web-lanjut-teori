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
        Schema::create("registrasi_pelanggan", function (Blueprint $table) {
            $table->increments("id_pelanggan");
            $table->string("nama");
            $table->string("email");
            $table->string("no_hp");
            $table->string("password");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("registrasi_pelanggan");
    }
};
