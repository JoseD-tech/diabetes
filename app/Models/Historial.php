<?php

namespace App\Models;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historial extends Model
{
    use HasFactory;
    public function HistoriaPaciente() {
        return $this->hasMany(Paciente::class, 'id', 'paciente_id');
    }
}
