<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

  // app/Http/Controllers/AuthController.php

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
    ]);

    if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
        // Autentikasi berhasil, arahkan ke dashboard
        return redirect()->route('dashboard.index');
    }

    // Autentikasi gagal, kembali ke form login dengan error
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}

    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // Password di-hash melalui mutator di model User
            'password' => $request->password,
        ]);
    
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('frontend.home')->with('success', 'Logged out successfully');
    }
}
