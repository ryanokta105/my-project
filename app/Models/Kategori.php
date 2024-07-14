<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['kode_kategori', 'jenis', 'gambar'];

    // Mengatur primary key ke 'kode'
    protected $primaryKey = 'kode_kategori';

    // Menentukan bahwa primary key bukan auto-incrementing
    public $incrementing = false;

    // Jika tipe primary key bukan integer
    protected $keyType = 'string';

    public function barang()
    {
        return $this->hasMany(Barang::class, 'kode_kategori', 'kode_kategori');
    }
}
