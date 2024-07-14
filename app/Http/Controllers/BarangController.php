<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BarangController extends Controller
{
    public function barang($jenis)
    {
        $barang = Barang::where('jenis', $jenis);
        return view('barang', compact('barang'));
    }

    public function edit_barang($kode_barang, $kategori)
    {
        // Temukan data kategori berdasarkan kode
        $edit_barang = Barang::where('kode_barang', $kode_barang)->firstOrFail();

        // Tampilkan view edit dengan data kategori
        return view('edit_barang', compact('edit_barang', 'kategori'));
    }

    public function update_barang(Request $request, $kode_barang)
    {
        // Validasi input
        $request->validate([
            'kode_barang' => 'required|string|max:255',
            'merek_barang' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tipe' => 'required|string|max:255',
            'tahun' => 'required',
        ]);


        // Temukan kategori berdasarkan kode
        $update_barang = Barang::findOrFail($kode_barang);

        // Update data kategori
        $update_barang->kode_barang = $request->input('kode_barang');
        $update_barang->merek_barang = $request->input('merek_barang');
        $update_barang->tipe = $request->input('tipe');
        $update_barang->tahun = $request->input('tahun');

        // Proses gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($update_barang->gambar) {
                Storage::delete('public/' . $update_barang->gambar);
            }

            // Unggah gambar baru
            $imagePath = $request->file('gambar')->store('image', 'public');
            $update_barang->gambar = $imagePath;
        }

        // Simpan perubahan
        $update_barang->save();

        // Redirect ke halaman utama dengan pesan sukses
        return redirect()->route('kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function store_barang(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:255',
            'merek_barang' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tipe' => 'required|string|max:255',
            'tahun' => 'required',
        ]);

        // Mengunggah gambar
        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('image', 'public');
        }

        // Menyimpan data produk
        $barang = new Barang();
        $barang->kode_barang = $request->kode_barang;
        $barang->merek_barang = $request->merek_barang;
        $barang->tipe = $request->tipe;
        $barang->tahun = $request->tahun;
        $barang->kode_kategori = $request->kode_kategori;
        $barang->gambar = $imagePath;
        $barang->save();

        return redirect()->route('kategori')->with('success', 'Category added successfully');
    }
}
