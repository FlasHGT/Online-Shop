<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Adrese;
use App\Models\KlientsKarte;
use App\Models\Pasutijums;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'vards',
        'uzvards',
        'dzimsanas_diena',
        'telefona_nr',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function adreses()
    {
        return $this->hasMany(Adrese::class);
    }
    
    public function klientaKartes()
    {
        return $this->hasMany(KlientsKarte::class);
    }
    
    public function pasutijumi()
    {
        return $this->hasMany(Pasutijums::class);
    }
}
