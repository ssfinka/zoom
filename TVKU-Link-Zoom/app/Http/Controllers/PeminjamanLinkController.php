<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\RiwayatPeminjaman;
use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PeminjamanLinkController extends Controller
{
    public function create()
    {
        return view('user.form-peminjaman'); // Menampilkan form peminjaman
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul_meeting' => 'required|string|max:255',
            'waktu_peminjaman' => 'required|date',
            'tujuan_penggunaan' => 'required|string|max:255',
            'permintaan_tambahan' => 'nullable|string',
        ]);

        // Simpan data peminjaman ke database
        Peminjaman::create([
            'judul_meeting' => $request->judul_meeting,
            'waktu_peminjaman' => $request->waktu_peminjaman,
            'tujuan_penggunaan' => $request->tujuan_penggunaan,
            'permintaan_tambahan' => $request->permintaan_tambahan,
            'user_id' => Auth::id(), // Menyimpan user_id dari pengguna yang sedang login
        ]);

        // Redirect ke halaman yang sesuai
        return redirect()->route('user.dashboard')->with('success', 'Peminjaman berhasil diajukan.');
    }

    public function markAsSelesai($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'Selesai';
        $peminjaman->save();
    }

    public function updateStatus(Request $request, $id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->status = $request->status;
        $peminjaman->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status updated successfully.');
    }

    public function approveForm($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $links = Link::where('status_peminjaman', 'Tersedia')->get();
        return view('admin.manajemen-link.approve-form', compact('peminjaman', 'links'));
    }

    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'ditolak';
        $peminjaman->save();

        return redirect()->route('admin.dashboard')->with('success', 'Peminjaman berhasil ditolak.');
    }

    public function approve(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Validasi input
        $request->validate([
            'link_zoom_id' => 'required|exists:links,id',
            'id_meeting' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'catatan_admin' => 'nullable|string',
        ]);

        // Update peminjaman dengan data yang dikirim dari form persetujuan
        $link = Link::findOrFail($request->input('link_zoom_id'));
        $peminjaman->update([
            'status' => 'disetujui',
            'link_zoom' => $link->link_zoom,
            'id_meeting' => $request->input('id_meeting'),
            'password' => $request->input('password'),
            'catatan_admin' => $request->input('catatan_admin'),
            'nama_peminjam' => $peminjaman->nama_peminjam ?: $request->user_name,
            'waktu_peminjaman' => $peminjaman->waktu_peminjaman ?: now(),
        ]);

        // Update status link Zoom menjadi "Sedang dipinjam"
        $link->status_peminjaman = 'Sedang dipinjam';
        $link->nama_peminjam = $peminjaman->nama_peminjam;
        $link->waktu_peminjaman = $peminjaman->waktu_peminjaman;
        $link->save();

        // Redirect ke dashboard admin
        return redirect()->route('admin.dashboard')->with('success', 'Peminjaman disetujui!');
    }

    public function detail($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('admin.manajemen-link.detail-peminjaman', compact('peminjaman')); // Menampilkan detail peminjaman
    }

    public function riwayat()
    {
        $riwayatPeminjaman = RiwayatPeminjaman::all();
        return view('admin.riwayat-peminjaman', compact('riwayatPeminjaman'));
    }

    // Method untuk menandai sebagai selesai
    public function markAsCompleted(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|string',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'Selesai';
        $peminjaman->feedback = $request->feedback;
        $peminjaman->save();

        return redirect()->route('user.dashboard')->with('success', 'Peminjaman berhasil diselesaikan dan feedback telah disimpan.');
    }

    // Method untuk mengirim feedback
    public function submitFeedback(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|string',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->feedback = $request->feedback;
        $peminjaman->save();

        return redirect()->route('user.dashboard')->with('success', 'Feedback submitted successfully');
    }
}
