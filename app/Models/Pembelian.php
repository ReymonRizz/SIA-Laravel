<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = "pembelian";
    protected $fillable = ["no_faktur", "karyawan", "tgl_beli", "cara_beli", "jatuh_tempo", "supplier", "barang", "keterangan", "jumlah", "harga_beli", "created_at", "updated_at"];
}