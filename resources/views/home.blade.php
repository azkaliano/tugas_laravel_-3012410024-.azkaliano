@extends('master')

@section('title', 'Home - LAWAK CHRONICLE')

@section('body')
<!-- Gunakan Tailwind CSS via CDN khusus untuk halaman ini agar tampilan koran digitalnya maksimal -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="w-full bg-[#fcfbf9] text-gray-900 font-sans antialiased min-h-screen mt-4 rounded-lg shadow-xs overflow-hidden border border-gray-200">

    <!-- TOP MINI BAR (Integrasi Info Login & Tombol Logout Asli Anda - FIXED) -->
    <div class="bg-gray-900 text-gray-300 text-xs py-3 px-4 border-b border-gray-800 flex flex-col sm:flex-row justify-between items-center gap-2">
        <div class="flex items-center space-x-2">
            <span class="inline-block w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
            <p>Selamat datang kembali, <span class="font-bold text-white">{{ Auth::user()->name }}</span>! (<span class="text-gray-400">{{ Auth::user()->email }}</span>)</p>
            <span class="bg-amber-500/20 text-amber-400 text-[10px] font-bold px-1.5 py-0.5 rounded ml-2 border border-amber-500/30 uppercase tracking-wider">Premium Member</span>
        </div>
        <div>
            <!-- Form Logout Diperbaiki Menggunakan onclick JavaScript Trigger Form Submit -->
            <form id="logout-form" method="POST" action="{{ url('/logout') }}" class="m-0 inline">
                @csrf
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-red-400 hover:text-red-300 font-semibold transition text-xs no-underline cursor-pointer">
                    Keluar Sistem (Logout) &rarr;
                </a>
            </form>
        </div>
    </div>

    <!-- MAIN BRANDING HEADER (Ala Detik / Kompas / CNN) -->
    <header class="py-6 border-b border-gray-200 bg-white">
        <div class="text-center">
            <h1 class="text-3xl md:text-5xl font-black tracking-tighter uppercase font-serif">
                LAWAK <span class="text-red-600 border-b-4 border-red-600">CHRONICLE</span>
            </h1>
            <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-2 font-mono">
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }} — Aktual, Tajam, & Terpercaya
            </p>
        </div>
    </header>

    <!-- NAVIGASI KATEGORI BERITA -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-40 shadow-xs">
        <div class="flex justify-center space-x-6 md:space-x-8 py-3 text-xs font-bold uppercase tracking-wider">
            <a href="{{ url('/home') }}" class="text-red-600 border-b-2 border-red-600 pb-1">Terbaru</a>
            <a href="{{ url('/category/teknologi') }}" class="text-gray-500 hover:text-red-600 transition">Teknologi</a>
            <a href="{{ url('/category/kesehatan') }}" class="text-gray-500 hover:text-red-600 transition">Kesehatan</a>
            <a href="{{ url('/category/travel') }}" class="text-gray-500 hover:text-red-600 transition">Travel</a>
            <a href="{{ url('/category/sains') }}" class="text-gray-500 hover:text-red-600 transition">Sains</a>
        </div>
    </nav>

    <!-- MAIN PORTAL CONTENT GRID -->
    <div class="p-4 md:p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- LEFT & CENTER COLUMN: BERITA UTAMA (HEADLINE HERO) -->
            <div class="lg:col-span-2 space-y-4">
                <div class="border-b-2 border-red-600 pb-1 flex justify-between items-end">
                    <h2 class="text-sm font-black uppercase tracking-tight text-red-600">Berita Utama</h2>
                    <span class="text-[10px] text-gray-400 font-mono">Headline of the Day</span>
                </div>
                
                @if(isset($headline) && $headline)
                <article class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-2xs hover:shadow-xs transition duration-300">
                    <div class="relative">
                        <img src="{{ $headline->image_url ?? 'https://via.placeholder.com/800x450' }}" alt="Headline" class="w-full h-80 object-cover">
                        <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 uppercase tracking-wide rounded">
                            {{ $headline->category }}
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl md:text-2xl font-serif font-black tracking-tight leading-tight hover:text-red-600 transition">
                            <a href="{{ url('/posts/'.$headline->id) }}">{{ $headline->title }}</a>
                        </h3>
                        
                        <div class="flex items-center text-[11px] text-gray-400 space-x-3 my-3 font-medium">
                            <span class="text-gray-800 font-bold bg-gray-100 px-2 py-0.5 rounded">✍️ {{ $headline->publisher }}</span>
                            <span>•</span>
                            <span>📅 {{ \Carbon\Carbon::parse($headline->published_at)->diffForHumans() }}</span>
                        </div>
                        
                        <p class="text-gray-600 leading-relaxed text-sm">
                            {{ Str::limit($headline->content, 250, '...') }}
                        </p>
                        
                        <div class="mt-4 pt-3 border-t border-gray-100 flex justify-between items-center text-xs">
                            <a href="{{ url('/posts/'.$headline->id) }}" class="font-bold uppercase tracking-wider text-red-600 hover:text-red-700 transition">
                                Baca Selengkapnya &rarr;
                            </a>
                            <span class="text-gray-400 font-mono">👁️ {{ $headline->views_count ?? 1250 }} pembaca</span>
                        </div>
                    </div>
                </article>
                @else
                <!-- Fallback Static Data jika Anda belum sempat menjalankan seeder/database -->
                <article class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-2xs">
                    <img src="https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?w=800" alt="Headline" class="w-full h-80 object-cover">
                    <div class="p-5">
                        <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 uppercase rounded">Teknologi</span>
                        <h3 class="text-xl md:text-2xl font-serif font-black tracking-tight mt-2 text-gray-900">
                            <a href="{{ url('/posts/static-1') }}" class="hover:text-red-600 transition">Eksplorasi Penerapan Kecerdasan Buatan (AI) di Sektor Pertanian Modern Indonesia</a>
                        </h3>
                        <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                            Integrasi teknologi AI dalam pemantauan lahan pertanian diproyeksikan mampu meningkatkan efisiensi panen nasional secara signifikan pada kuartal kedua tahun ini...
                        </p>
                    </div>
                </article>
                @endif
            </div>

            <!-- RIGHT COLUMN: DAFTAR BERITA TERKINI & SIDEBAR WIDGET -->
            <div class="lg:col-span-1 space-y-4">
                <div class="border-b-2 border-gray-900 pb-1 flex justify-between items-end">
                    <h2 class="text-sm font-black uppercase tracking-tight text-gray-900">Berita Terkini</h2>
                    <span class="text-[10px] text-gray-400 font-mono">Latest News</span>
                </div>
                
                <div class="space-y-3">
                    @if(isset($sidePosts) && $sidePosts->count() > 0)
                        @foreach($sidePosts as $post)
                        <article class="bg-white p-3 border border-gray-200 rounded-lg flex gap-3 hover:border-red-300 transition duration-200">
                            <img src="{{ $post->image_url ?? 'https://via.placeholder.com/150' }}" alt="Thumbnail" class="w-20 h-20 object-cover rounded bg-gray-100 flex-shrink-0">
                            <div class="flex flex-col justify-between">
                                <div>
                                    <span class="text-[9px] font-extrabold text-red-600 uppercase tracking-wide">{{ $post->category }}</span>
                                    <h4 class="font-serif font-bold text-xs text-gray-900 leading-snug line-clamp-2 hover:text-red-600 transition">
                                        <a href="{{ url('/posts/'.$post->id) }}">{{ $post->title }}</a>
                                    </h4>
                                </div>
                                <div class="text-[9px] text-gray-400 mt-1">
                                    <span class="font-bold text-gray-600">{{ $post->publisher }}</span> • {{ \Carbon\Carbon::parse($post->published_at)->diffForHumans() }}
                                </div>
                            </div>
                        </article>
                        @endforeach
                    @else
                        <!-- Data Statis Cadangan (Berita Terkini) -->
                        <article class="bg-white p-3 border border-gray-200 rounded-lg flex gap-3 hover:border-red-300 transition">
                            <img src="https://images.unsplash.com/photo-1586015555751-63bb77f4322a?w=150" class="w-20 h-20 object-cover rounded flex-shrink-0">
                            <div>
                                <span class="text-[9px] font-bold text-red-600 uppercase">Kesehatan</span>
                                <h4 class="font-serif font-bold text-xs text-gray-900 hover:text-red-600">
                                    <a href="{{ url('/posts/static-2') }}">Implementasi Sistem FEFO Berbasis Aplikasi Pada Logistik Farmasi</a>
                                </h4>
                                <p class="text-[10px] text-gray-400 mt-1">Oleh: Redaksi Utama</p>
                            </div>
                        </article>
                        <article class="bg-white p-3 border border-gray-200 rounded-lg flex gap-3 hover:border-red-300 transition">
                            <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=150" class="w-20 h-20 object-cover rounded flex-shrink-0">
                            <div>
                                <span class="text-[9px] font-bold text-red-600 uppercase">Travel</span>
                                <h4 class="font-serif font-bold text-xs text-gray-900 hover:text-red-600">
                                    <a href="{{ url('/posts/static-3') }}">Rute Penerbangan Terjadwal Menuju Melbourne Mengalami Lonjakan</a>
                                </h4>
                                <p class="text-[10px] text-gray-400 mt-1">Oleh: Redaksi Utama</p>
                            </div>
                        </article>
                    @endif
                </div>

                <!-- SIDEBAR PREMIUM CONTRIBUTOR WIDGET -->
                <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-red-950 text-white p-5 rounded-lg shadow-sm border border-gray-800">
                    <div class="flex items-center space-x-2 text-yellow-400 text-[10px] font-bold uppercase tracking-wider mb-2">
                        <span>⭐</span> <span>Kanal Kontributor</span>
                    </div>
                    <h4 class="text-sm font-serif font-bold mb-1">Kirim Artikel Opini Anda</h4>
                    <p class="text-[11px] text-gray-400 mb-4 leading-relaxed">
                        Sebagai user aktif (<span class="text-yellow-300 font-mono">{{ Auth::user()->name }}</span>), Anda berhak mengirimkan draf tulisan ilmiah atau populer Anda langsung ke sistem redaksi kami.
                    </p>
                    
                    <!-- LINK AKTIF KE HALAMAN FORM INPUT BARU -->
                    <a href="{{ url('/posts/create') }}" class="w-full inline-block text-center bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-2.5 px-3 rounded transition shadow-sm border-none no-underline">
                        + Tulis Berita Baru
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER PORTAL -->
    <footer class="bg-gray-900 text-gray-500 text-[10px] py-4 border-t border-gray-800 text-center">
        <p class="font-serif font-black text-white uppercase tracking-wider">LAWAK CHRONICLE</p>
        <p class="mt-1">&copy; 2026 LAWAK CHRONICLE . Dibuat Menggunakan Laravel & Tailwind CSS</p>
    </footer>

</div>
@stop