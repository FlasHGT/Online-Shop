<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Adrese;
use App\Models\KlientsKarte;
use App\Models\PasutijumsPrece;

class Pasutijums extends Model
{
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adrese()
    {
        return $this->belongsTo(Adrese::class);
    }
    
    public function klientaKarte()
    {
        return $this->belongsTo(KlientsKarte::class);
    }
    
    public function pasutijumaPreces()
    {
        return $this->hasMany(PasutijumsPrece::class);
    }
}
