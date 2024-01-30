<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');
            $table->timestamps();
        });

        DB::table('categorias')->insert([
            'categoria' => 'Hipocalórica'
        ]);
        DB::table('categorias')->insert([
            'categoria' => 'Normocalorica'
        ]);
        DB::table('categorias')->insert([
            'categoria' => 'Hipercalorica'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria');
    }
};
