<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class klasifikasi extends Model
{
    use HasFactory;

    protected $table = 'klasifikasi';
    protected $fillable = ['klasifikasi', 'kode_barang'];


    public function barang()
    {
        return $this->belongsTo(barang::class, 'kode_barang', 'kode_barang');
    }
}
