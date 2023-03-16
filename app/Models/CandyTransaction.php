<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CandyTransaction extends Model
{
    protected $table = "tb_event_candy_transaction";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transaction_hash',
        'block_number',
        'wallet',
        'amount',
        'price',
        'creator_tax',
        'market_tax',
        'last_price',
        'type',
        'body',
        'created_at',
        'updated_at',
        'candy_id',
        'chain_id'
    ];

    protected $hidden = [
        'body'
    ];

    protected $casts = [];

    public function candy()
    {
        return $this->belongsTo(Candy::class);
    }

    public function chain()
    {
        return $this->belongsTo(Chain::class);
    }

}
