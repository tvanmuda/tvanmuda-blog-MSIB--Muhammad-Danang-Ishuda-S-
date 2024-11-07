<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Menampilkan daftar post di dashboard admin
    public function index()
    {
        // Mengambil semua post (baik yang dipublikasikan maupun yang dalam draf) untuk admin
        $posts = Post::with('category', 'author')->paginate(10); // Menggunakan paginasi

        return view('posts.index', compact('posts'));
    }

    // Menampilkan post yang dipublikasikan di frontend
    public function home()
    {
        $posts = Post::with('category')
                     ->where('is_published', true)
                     ->paginate(10); 

        return view('frontend.home', compact('posts'));
    }

    // Menampilkan form pembuatan post
    public function create()
    {
        // Mengambil semua categories dan authors
        $categories = Category::all();
        $authors = Author::all(); // Ambil data authors
        return view('posts.create', compact('categories', 'authors'));
    }

    // Menyimpan post baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'title'         => 'required|string|max:255',
            'content'       => 'required|string',
            'image'         => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'is_published'  => 'nullable|boolean',
            'category_id'   => 'required|exists:categories,id',
            'author_id'     => 'required|exists:authors,id',
        ]);

        try {
            // Menyimpan gambar jika ada
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('asset-images', 'public');
            }

            // Membuat post baru
            Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imagePath,
                'is_published' => $request->boolean('is_published'), // Gunakan metode boolean
                'category_id' => $request->category_id,
                'author_id' => $request->author_id
            ]);

            return redirect()->route('posts.index')->with('success', 'Post created successfully');
        } catch (\Exception $err) {
            return redirect()->route('posts.index')->with('error', $err->getMessage());
        }
    }

    public function details($id)
    {
        $post = Post::with(['category', 'author'])->findOrFail($id);
    
        // Jika postingan tidak dipublikasikan, hanya penulisnya yang dapat melihatnya
        if (!$post->is_published) {
            if (!Auth::check() || Auth::id() !== $post->author_id) {
                abort(404, 'Post not found.');
            }
        }
    
        // Mendapatkan artikel lain yang dipublikasikan, kecuali post yang sedang dibuka
        $posts = Post::with('category')
            ->where('is_published', true)
            ->where('id', '!=', $post->id) // Mengecualikan post yang sedang dilihat
            ->limit(2) 
            ->get();
    
        return view('frontend.details', compact('posts', 'post'));
    }
    
    

    public function show($id)
    {
        // Mengambil post berdasarkan ID
        $post = Post::with(['category', 'author'])->findOrFail($id);
    
        // Mengembalikan tampilan dengan data post
        return view('posts.show', compact('post'));
    }
    
    
    // Menampilkan form pengeditan post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $authors = Author::all();
        return view('posts.edit', compact('post', 'categories', 'authors'));
    }

    
    public function update(Request $request, Post $post)
    {
        // Validasi input
        $request->validate([
            'title'         => 'required|string|max:255',
            'content'       => 'required|string',
            'image'         => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'is_published'  => 'nullable|boolean',
            'category_id'   => 'required|exists:categories,id',
            'author_id'     => 'required|exists:authors,id',
        ]);

        try {
           
            $imagePath = $post->image; 
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('asset-images', 'public');
            }

            // Memperbarui post
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imagePath,
                'is_published' => $request->boolean('is_published'), 
                'category_id' => $request->category_id,
                'author_id' => $request->author_id
            ]);

            return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui');
        } catch (\Exception $err) {
            return redirect()->route('posts.index')->with('error', $err->getMessage());
        }
    }

    // Menghapus post
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
