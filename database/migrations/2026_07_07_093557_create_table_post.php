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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->enum('published', ['yes', 'no'])->default('no');
            
            // --- FITUR TAMBAHAN (NILAI PLUS) ---
            $table->string('image_url')->nullable(); // Untuk menyimpan link/path thumbnail gambar berita
            $table->string('category')->default('Umum'); // Kategori berita (Teknologi, Kesehatan, dll)
            $table->string('publisher')->default('Redaksi Utama'); // Nama penulis atau penerbit berita
            $table->integer('views_count')->default(0); // Metrik pelengkap untuk menghitung jumlah pembaca
            $table->timestamp('published_at')->useCurrent(); // Waktu rilis berita untuk sistem pengurutan
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};