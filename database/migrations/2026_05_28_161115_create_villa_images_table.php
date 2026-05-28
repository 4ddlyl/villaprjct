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
        Schema::create('villa_images', function (Blueprint $table) {
            $table->id();

            // Menghubungkan ke tabel villas (FOREIGN KEY + INDEX otomatis)
            $table->foreignId('villa_id')
                ->constrained('villas')
                ->onDelete('cascade');

            $table->string('image_path', 255);
            $table->boolean('is_primary')->default(false);
            $table->integer('sort_order')->default(0);

            $table->timestamps(); // created_at & updated_at TIMESTAMP NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villa_images');
    }
};
