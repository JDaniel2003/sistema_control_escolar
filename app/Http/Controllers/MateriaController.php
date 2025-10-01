<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\PlanEstudio;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    // Mostrar todas las materias
    public function index()
    {
        $materias = Materia::with('planEstudio')->paginate(10);
        return view('materias.index', compact('materias'));
    }

    // Mostrar materias por plan de estudio
    public function materiasPorPlan($id_plan_estudio)
    {
        $plan = PlanEstudio::findOrFail($id_plan_estudio);
        $materias = Materia::where('id_plan_estudio', $id_plan_estudio)->get();

        return view('materias.materias_por_plan', compact('plan', 'materias'));
    }

    // Crear nueva materia
    public function create()
    {
        $planes = PlanEstudio::all();
        return view('materias.create', compact('planes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'id_plan_estudio' => 'required|integer|exists:planes_estudio,id_plan_estudio',
        ]);

        Materia::create($request->all());

        return redirect()->route('materias.index')->with('success', 'Materia creada correctamente.');
    }

    // Editar materia
    public function edit($id)
    {
        $materia = Materia::findOrFail($id);
        $planes = PlanEstudio::all();
        return view('materias.edit', compact('materia', 'planes'));
    }

    public function update(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:150',
            'id_plan_estudio' => 'required|integer|exists:planes_estudio,id_plan_estudio',
        ]);

        $materia->update($request->all());

        return redirect()->route('materias.index')->with('success', 'Materia actualizada correctamente.');
    }

    // Eliminar materia
    public function destroy($id)
    {
        $materia = Materia::findOrFail($id);
        $materia->delete();

        return redirect()->route('materias.index')->with('success', 'Materia eliminada correctamente.');
    }
}
