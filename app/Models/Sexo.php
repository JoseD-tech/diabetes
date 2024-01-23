<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{

    protected $fillable = ['sexo'];

    use HasFactory;
    public function PacienteSexo(){
        return $this->hasMany(Paciente::class);
    }
}
