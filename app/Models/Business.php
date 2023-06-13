<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Business extends Authenticatable
{

    protected $table = "tb_business";

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
        'horarios',
        'info_adicionais',
        'user_id',
        'category_id',
        'latitude',
        'longitude'
    ];

    protected $casts = [
        'info_adicionais' => 'array',
        'horarios' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function files()
    {
        return $this->hasMany(Files::class);
    }

}
