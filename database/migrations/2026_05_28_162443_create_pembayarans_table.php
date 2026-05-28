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
    Schema::create('pembayarans', function (Blueprint $table) {
        $table->id(); 
        $table->foreignId('reservasi_id')->constrained('reservasis')->onDelete('cascade');
        
        $table->string('metode', 50);
        $table->string('bukti_pembayaran', 255);
        $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
        $table->text('catatan_penolakan')->nullable(); 
        $table->timestamps(); 
        $table->index('status');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
