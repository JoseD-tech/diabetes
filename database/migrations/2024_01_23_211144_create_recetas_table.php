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
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descripcion');
            $table->text('receta');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references("id")->on('categorias');
            /*
            $table->boolean('oc')->default(false);
            $table->boolean('pp')->default(false);
            $table->boolean('phe')->default(false);
            $table->boolean('emp')->default(false);
            $table->boolean('he')->default(false);
            $table->boolean('afd')->default(false);
            $table->boolean('pem')->default(false);
            $table->boolean('dc')->default(false);
            $table->boolean('oa')->default(false);*/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recetas');
    }
};
