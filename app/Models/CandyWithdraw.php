<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class CandyWithdraw extends Model
{
    protected $table = "tb_event_withdraw";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'wallet',
        'amount',
        'price',
        'type',
        'body',
        'candy_id'
    ];

    protected $casts = [];

    public function candy()
    {
        return $this->belongsTo(Candy::class);
    }

}
