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
        Schema::create("pesanan", function(Blueprint $table) {
            $table->bigIncrements("id_pesanan");
            $table->integer("jumlah");
            $table->double("harga_total", 16, 2);
            $table->unsignedBigInteger("id_menu");
            $table->unsignedBigInteger("id_reservasi");
            $table->timestamps();
            $table->foreign('id_menu')->references('id_menu')->on('menu');
            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("pesanan");
    }
};
