<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Barang extends Model
{
    use HasFactory;
    protected $table = "barang";
    protected $fillable = ["kode_barang", "nama_barang", "jumlah_stok", "harga_jual", "harga_beli"];
}