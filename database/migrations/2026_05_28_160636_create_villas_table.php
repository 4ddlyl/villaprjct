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
        Schema::create('villas', function (Blueprint $table) {
            $table->id();

            $table->string('nama_villa', 100);
            $table->string('lokasi', 150);
            $table->integer('harga_per_malam');
            $table->integer('kapasitas');
            $table->integer('jumlah_kamar');
            $table->text('fasilitas')->nullable();
            $table->enum('status', ['tersedia', 'tidak tersedia'])->default('tersedia');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villas');
    }
};
