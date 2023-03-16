<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chain extends Model
{
    use HasFactory;

    protected $table = "tb_chain";

    protected $fillable = [
        'id',
        'name',
        'currency',
        'image',
        'active',
        'addr_candy',
        'addr_candyswap',
        'addr_token_market',
        'addr_token',
    ];


}
