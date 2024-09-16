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
            $table->increments("id_pesanan");
            $table->integer("jumlah");
            $table->double("harga_total", 16, 2);
            $table->integer("id_menu");
            $table->integer("reservasi");
            $table->foreign("id_menu")->references("id_menu")->on("menu")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("id_reservasi")->references("id_reservasi")->on("reservasi")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
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
