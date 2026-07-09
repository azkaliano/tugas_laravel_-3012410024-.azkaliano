<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post; // Import model Post
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // Import class Str untuk membuat slug otomatis

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. SEEDER USER (Bawaan Anda untuk Autentikasi Login)
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        // 2. SEEDER BERITA OLA PORTAL BERITA (Fitur Nilai Plus)
        $articles = [
            [
                'title' => 'Eksplorasi Rute Penerbangan Langsung Padang Menuju Melbourne Resmi Dibuka Tahun Ini',
                'content' => 'Guna meningkatkan konektivitas internasional dan menggenjot sektor pariwisata di Sumatera Barat, maskapai nasional resmi membuka rute penerbangan langsung baru. Rute ini diharapkan mempermudah mobilitas pebisnis dan pelancong dari Australia menuju Indonesia barat.',
                'image_url' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800',
                'category' => 'Travel',
                'publisher' => 'Azkaliano Redaksi',
                'published' => 'yes'
            ],
            [
                'title' => 'Penerapan Sistem FEFO Berbasis AI Ubah Wajah Manajemen Stok Farmasi Modern',
                'content' => 'Sistem manajemen inventaris berbasis First Expired, First Out (FEFO) kini mulai mengintegrasikan kecerdasan buatan (AI) untuk memprediksi masa kedaluwarsa obat secara real-time. Inovasi ini menekan angka kerugian operasional apotek hingga kisaran 35%.',
                'image_url' => 'https://images.unsplash.com/photo-1586015555751-63bb77f4322a?w=600',
                'category' => 'Kesehatan',
                'publisher' => 'Azkaliano Redaksi',
                'published' => 'yes'
            ],
            [
                'title' => 'Dampak Positif Implementasi Artificial Intelligence pada Sektor Pertanian Skala Makro',
                'content' => 'Penggunaan sensor pintar berbasis AI untuk mendeteksi kelembapan tanah dan mengotomatisasi pemupukan mulai diadopsi oleh petani lokal. Hasil panen dilaporkan meningkat stabil dengan kualitas komoditas yang jauh lebih kompetitif di pasar global.',
                'image_url' => 'https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?w=600',
                'category' => 'Teknologi',
                'publisher' => 'Editor Team',
                'published' => 'yes'
            ]
        ];

        foreach ($articles as $art) {
            Post::create([
                'title' => $art['title'],
                'content' => $art['content'],
                'published' => $art['published'], // Mengisi kolom enum bawaan Anda ('yes'/'no')
                'image_url' => $art['image_url'],
                'category' => $art['category'],
                'publisher' => $art['publisher'],
                'published_at' => now(),
            ]);
        }
    }
}