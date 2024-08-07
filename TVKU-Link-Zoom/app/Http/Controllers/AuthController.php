<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Link;
use App\Http\Controllers\ManageLinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek role dan arahkan ke halaman yang sesuai
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard'); // Atur rute untuk halaman dashboard user
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Menampilkan form registrasi
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    // Memproses data registrasi
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|in:admin,staff,tamu,pembicara',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke login page setelah registrasi berhasil
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }


    public function index(Request $request)
    {
        // Handle search
        $query = Peminjaman::query();
    
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_peminjam', 'like', "%$search%")
                    ->orWhere('judul_meeting', 'like', "%$search%")
                    ->orWhere('permintaan_tambahan', 'like', "%$search%")
                    ->orWhereDate('waktu_peminjaman', $search);
            });
        }
    
        // Check for peminjaman older than 24 hours and move to history
        $peminjamanExpired = Peminjaman::where('created_at', '<', Carbon::now()->subDay())->get();
    
        foreach ($peminjamanExpired as $expired) {
            // Move to history
            DB::table('riwayat_peminjaman')->insert([
                'user_id' => $expired->user_id,
                'judul_meeting' => $expired->judul_meeting,
                'waktu_peminjaman' => $expired->waktu_peminjaman,
                'tujuan_penggunaan' => $expired->tujuan_penggunaan,
                'permintaan_tambahan' => $expired->permintaan_tambahan,
                'status' => $expired->status,
                'created_at' => $expired->created_at,
                'updated_at' => $expired->updated_at,
            ]);
    
            // Delete from current peminjaman table
            $expired->delete();
        }
    
        // Get active peminjaman with sorting
        $peminjaman = $query->orderByRaw("CASE
            WHEN status = 'Menunggu Persetujuan' THEN 1
            WHEN status = 'disetujui' THEN 2
            WHEN status = 'ditolak' THEN 3
            ELSE 4
        END")
            ->orderBy('waktu_peminjaman', 'desc') // Mengurutkan berdasarkan waktu peminjaman terbaru
            ->get();
    
        // Count total peminjaman yang disetujui
        $totalPeminjamanDisetujui = Peminjaman::where('status', 'disetujui')->count();
    
        // Count total available link Zoom
        $totalLinkZoom = Link::where('status_peminjaman', 'Tersedia')->count();
    
        return view('admin.dashboard', compact('peminjaman', 'totalPeminjamanDisetujui', 'totalLinkZoom'));
    }
    

    // Mengelola proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Successfully logged out');
    }
}
