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
        Schema::create('ulasan', function(Blueprint $table){
            $table->bigIncrements('id_ulasan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('ulasan');
            $table->timestamps();
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
