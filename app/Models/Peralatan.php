<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    use HasFactory;
    protected $table = "peralatan";
    protected $fillable = ["nama_aset", "tgl_aset", "jumlah_aset", "harga_aset", "masa_manfaat"];
}