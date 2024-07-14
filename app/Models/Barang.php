<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = ['kode_barang', 'merek_barang', 'gambar', 'tipe', 'tahun', 'kode_kategori'];

    // Mengatur primary key ke 'kode'
    protected $primaryKey = 'kode_barang';

    // Menentukan bahwa primary key bukan auto-incrementing
    public $incrementing = false;

    // Jika tipe primary key bukan integer
    protected $keyType = 'string';

    public function barang()
    {
        return $this->belongsTo(Kategori::class, 'kode_kategori', 'kode_kategori');
    }
}
