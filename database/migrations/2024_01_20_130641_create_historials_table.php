<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historials', function (Blueprint $table) {
            $table->id();
            $table->foreignId("paciente_id")->require()->constrained('pacientes');
            $table->text("doctor")->require();
            $table->text('descripcion')->require();
            $table->text("resultado")->require();
            $table->boolean('oc')->default(false);
            $table->boolean('pp')->default(false);
            $table->boolean('phe')->default(false);
            $table->boolean('emp')->default(false);
            $table->boolean('he')->default(false);
            $table->boolean('afd')->default(false);
            $table->boolean('pem')->default(false);
            $table->boolean('dc')->default(false);
            $table->boolean('oa')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historials');
    }
};
