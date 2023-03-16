<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class Candy extends Model
{
    protected $table = "tb_candy";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'hashtags',
        'website',
        'explicit',
        'public_chat',
        'community',
        'blocked',
        'active',
        'user_id',
        'properties',
        'stats',
        'levels',
        'link',
        'category_id'
    ];

    protected $casts = [
        'properties' => 'array',
        'stats' => 'array',
        'levels' => 'array'
    ];

    protected $hidden = [
        'user_id'
    ];

    protected $appends = [
        'has_eth',
    ];
    
    
    public function getHasEthAttribute(){
        $id = $this->id;
        $candy = Cache::remember('candy:has_eth:'.$this->id, Carbon::now()->addHours(env('REDIS_CACHE_HOURS')), function () use ($id) {
            $check1 = CandyMint::where('candy_id', $this->id)->where('chain_id', 1)->first();
            $check2 = CandyMint::where('candy_id', $this->id)->where('chain_id', 137)->first();
            $check3 = CandyMint::where('candy_id', $this->id)->where('chain_id', 56)->first();
            $check4 = CandyMint::where('candy_id', $this->id)->where('chain_id', 11155111)->first();
            return [
                'ethereum' => ($check1 !== null),
                'polygon' => ($check2 !== null),
                'binance' => ($check3 !== null),
                'seplia' => ($check4 !== null),
            ];
        });
        return $candy;
    }

    public function files()
    {
        return $this->hasMany(Files::class)->where('active', true)->where('private', false);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lastPrice()
    {
        return $this->hasOne(CandyTransaction::class)
        ->orderBy('id', 'DESC');
    }

    public function mints()
    {
        return $this->hasMany(CandyMint::class);
    }

}
