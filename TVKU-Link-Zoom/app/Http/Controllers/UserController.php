<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        // Ambil data peminjaman dari database untuk user yang sedang login
        $peminjaman = Peminjaman::where('user_id', Auth::id())->get();

        // Teruskan data ke view
        return view('user.dashboard', compact('peminjaman'));
    }
}
