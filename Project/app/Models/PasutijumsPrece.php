<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Prece;
use App\Models\Pasutijums;

class PasutijumsPrece extends Model
{
    use HasFactory;
    
    protected $table = 'pasutijumipreces';
    
    protected $fillable = ['prece_id', 'pasutijums_id', 'skaits'];
    
    public function prece()
    {
        return $this->belongsTo(Prece::class);
    }

    public function pasutijums()
    {
        return $this->belongsTo(Pasutijums::class);
    }
}
