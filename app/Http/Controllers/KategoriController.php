<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KategoriController extends Controller
{
    public function kategori()
    {
        $kategori = Kategori::all();
        return view('kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kategori' => 'required|string',
            'jenis' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mengunggah gambar
        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('image', 'public');
        }

        // Menyimpan data produk
        $kategori = new Kategori();
        $kategori->kode_kategori = $request->kode_kategori;
        $kategori->jenis = $request->jenis;
        $kategori->gambar = $imagePath;
        $kategori->save();

        return redirect()->route('kategori')->with('success', 'Category added successfully');
    }

    public function destroy($kode_kategori)
    {
        // Temukan data kategori berdasarkan id
        $kategori = Kategori::where('kode_kategori', $kode_kategori)->firstOrFail();

        // Hapus file gambar terkait jika ada
        if ($kategori->gambar) {
            Storage::delete('public/' . $kategori->gambar);
        }

        // Hapus data kategori
        $kategori->delete();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('kategori')->with('success', 'Category added successfully');
    }

    public function destroy_barang($kode_barang)
    {
        // Temukan data kategori berdasarkan id
        $barang = Barang::where('kode_barang', $kode_barang)->firstOrFail();

        // Hapus file gambar terkait jika ada
        if ($barang->gambar) {
            Storage::delete('public/' . $barang->gambar);
        }

        // Hapus data kategori
        $barang->delete();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('barang')->with('success', 'Category added successfully');
    }

    public function edit_kategori($kode_kategori)
    {
        // Temukan data kategori berdasarkan kode
        $edit_kategori = Kategori::where('kode_kategori', $kode_kategori)->firstOrFail();

        // Tampilkan view edit dengan data kategori
        return view('edit_kategori', compact('edit_kategori'));
    }

    public function update(Request $request, $kode_kategori)
    {
        // Validasi input
        $request->validate([
            'kode_kategori' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Temukan kategori berdasarkan ID
        $kategori = Kategori::findOrFail($kode_kategori);

        // Update data kategori
        $kategori->kode_kategori = $request->input('kode_kategori');
        $kategori->jenis = $request->input('jenis');

        // Proses gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kategori->gambar) {
                Storage::delete('public/' . $kategori->gambar);
            }

            // Unggah gambar baru
            $imagePath = $request->file('gambar')->store('image', 'public');
            $kategori->gambar = $imagePath;
        }

        // Simpan perubahan
        $kategori->save();

        // Redirect ke halaman utama dengan pesan sukses
        return redirect()->route('kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function showBarang($jenis)
    {
        try {
            $kategori = Kategori::with('barang')->where('jenis', $jenis)->firstOrFail();
            // Ambil kategori beserta barangnya berdasarkan kode_kategori
        } catch (ModelNotFoundException $e) {
            return redirect()->route('kategori')->with('error', 'Kategori tidak ditemukan');
            // Redirect ke halaman index jika kategori tidak ditemukan
        }

        return view('barang', compact('kategori')); // Tampilkan view dengan data kategori dan barang
    }
}
