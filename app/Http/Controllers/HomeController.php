<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Ambil user yang sedang login (seperti di screenshot Anda)
        $user = Auth::user();

        // Ambil semua berita
        $allPosts = Post::orderBy('published_at', 'desc')->get();
        
        // Pisahkan berita utama (Headline) dan berita sampingan
        $headline = $allPosts->first();
        $sidePosts = $allPosts->skip(1);

        return view('home', compact('user', 'headline', 'sidePosts'));
    }
}