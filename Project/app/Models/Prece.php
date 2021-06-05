<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PasutijumsPrece;
use App\Models\Kategorija;

class Prece extends Model
{
    use HasFactory;
    
    public function kategorija()
    {
        return $this->belongsTo(Kategorija::class);
    }
    
    public function pasutijumiPreces()
    {
        return $this->hasMany(PasutijumsPrece::class);
    }
}
