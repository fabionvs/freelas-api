<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class CandyMint extends Model
{
    protected $table = "tb_event_mint";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transaction_hash',
        'block_number',
        'amount',
        'value',
        'candy_id',
        'chain_id'
    ];

    protected $casts = [];

    public function candy()
    {
        return $this->belongsTo(Candy::class);
    }

}
