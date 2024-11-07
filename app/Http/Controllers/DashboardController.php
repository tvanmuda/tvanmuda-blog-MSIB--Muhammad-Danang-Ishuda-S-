<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Author; 
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     // Mengambil total dari setiap tabel
    //     $totalCategories = Category::count();
    //     $totalPosts = Post::count();
    //     $totalAuthors = Author::count();

    //     return view('dashboard.index', compact('totalCategories', 'totalPosts', 'totalAuthors'));
    // }
    public function index()
{
    $totalCategories = Category::count();
    $totalPosts = Post::count();
    $totalAuthors = Author::count();

    $recentPosts = Post::latest()->take(5)->get();
    $recentCategories = Category::latest()->take(5)->get();
    $recentAuthors = Author::latest()->take(5)->get();

    return view('dashboard.index', compact('totalCategories', 'totalPosts', 'totalAuthors', 'recentPosts', 'recentCategories', 'recentAuthors'));
}

}

