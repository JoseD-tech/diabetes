<?php

namespace App\Models;

use App\Models\Citas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Secretaria extends Model
{
    use HasFactory;
    public function Secretarios() {
        return $this->belongsTo(Citas::class);
    }
    public function HistorialSecretatios(){
        return $this->belongsTo(Historial::class);
    }
}
