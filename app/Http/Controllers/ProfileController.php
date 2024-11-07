<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Tampilkan detail profil pengguna yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();

        // Mengirim data pengguna ke view profil
        return view('profile.show', compact('user'));
    }
}
