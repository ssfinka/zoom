<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class ManageLinkController extends Controller
{
    // Menampilkan daftar link Zoom
    public function index(Request $request)
    {
        // Ambil parameter status dari request
        $status = $request->get('status');

        // Jika ada filter status, gunakan filter tersebut
        if ($status) {
            $links = Link::where('status_peminjaman', $status)->get();
        } else {
            $links = Link::all();
        }

        // Tampilkan view dengan data links yang sudah difilter
        return view('admin.manajemen-link.manage-links', compact('links'));
    }


    // Menampilkan form pembuatan link Zoom
    public function create()
    {
        return view('admin.manajemen-link.create-links');
    }

    // Menyimpan link Zoom baru
    public function store(Request $request)
    {
        $request->validate([
            'link_zoom' => 'required|string|unique:links,link_zoom',
            'meeting_id' => 'required|string|unique:links,meeting_id',
            'password_code' => 'required|string|unique:links,password_code',
            'nama_peminjam' => 'nullable|string|required_if:status_peminjaman,Sedang dipinjam',
            'waktu_peminjaman' => 'nullable|date|required_if:status_peminjaman,Sedang dipinjam',
            'status_peminjaman' => 'required|in:Tersedia,Sedang dipinjam',
        ], [
            'nama_peminjam.required_if' => 'Field Nama Peminjam diperlukan jika Status Peminjaman adalah Sedang dipinjam.',
            'waktu_peminjaman.required_if' => 'Field Waktu Peminjaman diperlukan jika Status Peminjaman adalah Sedang dipinjam.',
        ]);

        Link::create($request->all());

        return redirect()->route('admin.manage-links')->with('success', 'Link Zoom berhasil ditambahkan.');
    }

    // Menampilkan form edit link Zoom
    public function edit($id)
    {
        $link = Link::findOrFail($id);
        return view('admin.manajemen-link.edit-links', compact('link'));
    }

    // Mengupdate link Zoom
    public function update(Request $request, $id)
    {
        $link = Link::findOrFail($id);

        $request->validate([
            'link_zoom' => 'required|string|unique:links,link_zoom,' . $link->id,
            'meeting_id' => 'required|string|unique:links,meeting_id,' . $link->id,
            'password_code' => 'required|string|unique:links,password_code,' . $link->id,
            'nama_peminjam' => 'nullable|string|required_if:status_peminjaman,Sedang dipinjam',
            'waktu_peminjaman' => 'nullable|date|required_if:status_peminjaman,Sedang dipinjam',
            'status_peminjaman' => 'required|in:Tersedia,Sedang dipinjam',
        ], [
            'nama_peminjam.required_if' => 'Field Nama Peminjam diperlukan jika Status Peminjaman adalah Sedang dipinjam.',
            'waktu_peminjaman.required_if' => 'Field Waktu Peminjaman diperlukan jika Status Peminjaman adalah Sedang dipinjam.',
            'link_zoom.unique' => 'Link Zoom sudah digunakan.',
            'meeting_id.unique' => 'ID Meeting sudah digunakan.',
            'password_code.unique' => 'Kode Password sudah digunakan.',
        ]);

        $link->update($request->all());

        return redirect()->route('admin.manage-links')->with('success', 'Link Zoom berhasil diperbarui.');
    }

    // Menampilkan detail link Zoom
    public function show($id)
    {
        $link = Link::findOrFail($id);
        return view('admin.manajemen-link.show-links', compact('link'));
    }

    // Menghapus link Zoom
    public function destroy($id)
    {
        $link = Link::findOrFail($id);
        $link->delete();

        return redirect()->route('admin.manage-links')->with('success', 'Link Zoom berhasil dihapus.');
    }
}
