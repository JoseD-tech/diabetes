<?php

namespace App\Models;

use App\Models\Citas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estado extends Model
{
    use HasFactory;
    public function Estados(){
        return $this->hasMany(Citas::class);
    }
}
