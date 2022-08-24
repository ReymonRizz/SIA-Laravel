<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BebanPeralatan extends Model
{
    use HasFactory;

    protected $table = "beban_peralatan";

    protected $guarded = [
        'update_at',
        'create_at',
    ];
}