<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use Inertia\Inertia;
use App\Models\Doctor;
use App\Models\Historial;
use App\Models\Paciente;
use App\Models\Receta;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //retorna la vista de Doctores

        $citas = Citas::with('PacienteCita')->get();
        $historial = Historial::with('HistoriaPaciente')->get();
        $recetas = Receta::all();
        return Inertia::render('Doctor/Index', [
            'citas' => $citas,
            'reporte' => $historial,
            'recetas' => $recetas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('Doctor/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Registra el Historial de la cita y cambiar el estado
        // Guardar En historial
        $consulta = new Historial;
        $consulta->paciente_id = $request->input("paciente");
        $consulta->doctor = $request->input("doctor");
        $consulta->descripcion = $request->input("descripcion");
        $consulta->resultado = $request->input("resultado");
        $consulta->peso = $request->input("peso");
        $consulta->altura = $request->input("altura");
        $consulta->glisemia = $request->input("glisemia");
        $consulta->oc = $request->input('oc');
        $consulta->pp = $request->input('pp');
        $consulta->phe = $request->input('phe');
        $consulta->emp = $request->input('emp');
        $consulta->he = $request->input('he');
        $consulta->afd = $request->input('afd');
        $consulta->pem = $request->input('pem');
        $consulta->dc = $request->input('dc');
        $consulta->oa = $request->input('oa');
        $consulta->save();

        // cambia el estado de la cita
        $cita = Citas::findOrFail($request->input("id"));
        $cita->estado_id = 2;
        $cita->save();

        return to_route('doctor.edit', $cita->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //

        dd($id, Historial::where('paciente_id', $id)->get());

        $paciente = Paciente::find($id);
        $historial = Historial::where('paciente_id', $id)->get();
        $recetas = Receta::all();
        return Inertia::render('Doctor/Edit', [
            'pacientes' => $paciente,
            'historial' => $historial,
            'recetas' => $recetas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //edita los valores de doctor
        $doctor = Doctor::findOrFail($id);
        $doctor->doctor = $request->input('doctor');
        $doctor->save();
        return to_route('doctor.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
        $doctor->delete();
    }
}
