<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\klasifikasi;
use Illuminate\Http\Request;

class KlasifikasiController extends Controller
{
    public function klasifikasi()
    {
        $klasifikasi = klasifikasi::with('barang')->get();
        $barang = Barang::all();

        return view('klasifikasi', compact('klasifikasi', 'barang'));
    }

    public function store_klasifikasi(Request $request)
    {
        $request->validate([
            'klasifikasi' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255',
        ]);

        // Menyimpan data produk
        $klasifikasi = new klasifikasi();
        $klasifikasi->klasifikasi = $request->klasifikasi;
        $klasifikasi->kode_barang = $request->kode_barang;
        $klasifikasi->save();

        return redirect()->route('klasifikasi')->with('success', 'Category added successfully');
    }

    public function destroy_klasifikasi($id)
    {
        // Temukan data kategori berdasarkan id
        $klasifikasi_klasifikasi = klasifikasi::where('id', $id)->firstOrFail();

        // Hapus data kategori
        $klasifikasi_klasifikasi->delete();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('klasifikasi')->with('success', 'Category added successfully');
    }

    public function edit_klasifikasi($id, $kode_barang)
    {
        // Temukan data kategori berdasarkan kode
        $edit_klasifikasi = klasifikasi::where('id', $id)->firstOrFail();

        // Tampilkan view edit dengan data kategori
        return view('edit_klasifikasi', compact('edit_klasifikasi', 'kode_barang'));
    }

    public function update_klasifikasi(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'klasifikasi' => 'required|string|max:255',
        ]);


        // Temukan kategori berdasarkan kode
        $update_klasifikasi = klasifikasi::findOrFail($id);

        // Update data kategori
        $update_klasifikasi->klasifikasi = $request->input('klasifikasi');

        // Simpan perubahan
        $update_klasifikasi->save();

        // Redirect ke halaman utama dengan pesan sukses
        return redirect()->route('klasifikasi')->with('success', 'Kategori berhasil diperbarui.');
    }
}
