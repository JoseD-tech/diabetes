<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. edad, sexo, idice de masa colporal, glucosa pre y pos trigliserios colesterol
     */
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->require();
            $table->string('apellido')->require();
            $table->string('edad')->require();
            $table->unsignedBigInteger('sexo');
            $table->foreign('sexo')->references("id")->on('sexos');
            $table->string('cedula')->require();
            $table->string('telefono')->require();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
