<?php

namespace App\Models;

use App\Models\Citas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paciente extends Model
{
    use HasFactory;
    public function PacientesCitas () {
        return $this->belongsTo(Citas::class, 'id', 'paciente_id');
    }
    public function HistorialPacientes(){
        return $this->belongsTo(Historial::class, 'id', "paciente_id");
    }
}
