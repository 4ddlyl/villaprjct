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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('villa_id')->constrained('villas')->onDelete('cascade');

            $table->date('checkin');
            $table->date('checkout');
            $table->integer('total_harga');

            $table->enum('status', ['pending', 'dibayar', 'ditolak', 'selesai'])->default('pending');

            $table->timestamps(); 
            $table->index('status');
            $table->index('checkin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
