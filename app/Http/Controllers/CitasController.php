<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Citas;
use App\Models\Paciente;
use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::class;
        $roles = [];
        $doctores = DB::table('model_has_roles')->where('role_id', 2)->get();

        foreach ($doctores as $doctor) {
            $doctor = User::where('id',$doctor->model_id)->first();
            array_push($roles, $doctor);
        }

        //retona las Citas
        $citas = Citas::with('PacienteCita')->get();
        $historial = Historial::with('HistoriaPaciente')->get();
        return Inertia::render('Citas/Index', [
            "pacientes" => Paciente::all(),
            "doctores" => $roles, //para saber cuales son lo roles de doctor
            "citas" => $citas,
            "historial" => $historial
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Guarda la cita
        $cita = new Citas;
        $cita->decripcion = $request->input('descripcion');
        $cita->paciente_id = $request->input('paciente');
        $cita->doctor = $request->input('doctor');
        $cita->fecha_cita = $request->input('fecha');
        $cita->estado_id = 1;
        $cita->save();
        return to_route('citas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Citas $cita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Citas $cita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Citas $Cita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citas $Cita)
    {
        //
    }

}
