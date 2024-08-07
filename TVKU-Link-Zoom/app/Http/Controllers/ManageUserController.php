<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index(Request $request)
    {
        // Ambil parameter role dan search dari query string
        $role = $request->input('role');
        $search = $request->input('search');
        
        // Query untuk mengambil data pengguna dengan filter
        $users = User::when($role, function($query, $role) {
            return $query->where('role', $role);
        })->when($search, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            });
        })->get();
        
        // Kirim data ke tampilan
        return view('admin.manajemen-user.manage-users', [
            'users' => $users,
            'role' => $role,
            'search' => $search
        ]);
    }
    

    // Menampilkan form pembuatan pengguna baru
    public function create()
    {
        return view('admin.manajemen-user.create-users');
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,staff,tamu,pembicara',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.manage-users')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.manajemen-user.edit-users', compact('user'));
    }

    // Mengupdate pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,staff,tamu,pembicara',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.manage-users')->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Menampilkan detail pengguna
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.manajemen-user.detail-users', compact('user'));
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.manage-users')->with('success', 'Pengguna berhasil dihapus.');
    }
}
