<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Estado;
use App\Models\Paciente;
use App\Models\Historial;
use App\Models\Secretaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Citas extends Model
{
    use HasFactory;
    public function PacienteCita() {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
    }
    public function Doctor() {
        return $this->belongsTo(Doctor::class);
    }
    public function Secretario(){
        return $this->belongsTo(Secretaria::class);
    }
    public function Estado(){
        return $this->belongsTo(Estado::class);
    }
    public function HistorialCitas(){
        return $this->belongsTo(Historial::class);
    }
}
