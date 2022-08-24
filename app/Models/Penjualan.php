<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = "penjualan";
    protected $fillable = ["no_faktur", "karyawan", "tgl_jual", "cara_jual", "jatuh_tempo", "keterangan", "customer", "barang", "jasa", "diskon", "jumlah", "created_at", "updated_at"];
}