<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Secretaria;
use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('Secretario/Index', [
            'secretarios' => Secretaria::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('Secretario/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $secretario = new Secretaria;
        $secretario->secretario = $request->input('secretaria');
        $secretario->save();
        return to_route('secretario.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Secretaria $secretaria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request , $id)
    {
        //
        $secretario = Secretaria::findOrFail($id);
        return Inertia::render('Secretario/Edit', [
            'secretario' => $secretario
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //edita los valores de doctor
        $secretario = Secretaria::findOrFail($id);
        $secretario->secretario = $request->input('secretario');
        $secretario->save();
        return to_route('secretario.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        //elimina la secretaria
        $secretario = Secretaria::findOrFail($id);
        $secretario->delete();
        return to_route('secretario.index');
    }
}
