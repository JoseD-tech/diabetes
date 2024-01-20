<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    public function Doctores() {
        return $this->belongsTo(Citas::class);
    }
    public function HistorialDotores(){
        return $this->belongsTo(Historial::class);
    }
}
