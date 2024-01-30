<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Paciente;
use App\Models\Receta;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('Recetas/Index', [
            'recetas' => Receta::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categoria = Categoria::all();
        return Inertia::render('Recetas/Create', [
            'categorias' => $categoria
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $receta = new Receta;
        $receta->titulo = $request->input('titulo');
        $receta->descripcion = $request->input('descripcion');
        $receta->receta = $request->input('receta');
        $receta->categoria_id = $request->input('categoria');
        /*$receta->oc = $request->input('oc');
        $receta->pp = $request->input('pp');
        $receta->phe = $request->input('phe');
        $receta->emp = $request->input('emp');
        $receta->he = $request->input('he');
        $receta->afd = $request->input('afd');
        $receta->pem = $request->input('pem');
        $receta->dc = $request->input('dc');
        $receta->oa = $request->input('oa');*/
        $receta->save();
        return to_route('recetas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Receta $receta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receta $receta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receta $receta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receta $receta)
    {
        //
    }

    public function verdietas() {
        // ver  las dietas
        $paciente = Paciente::find(1);
        dd($paciente);
    }
}
