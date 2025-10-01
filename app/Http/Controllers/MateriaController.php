<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\PlanEstudio;
use App\Models\NumeroPeriodo;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    // Mostrar todas las materias
    public function index()
    {
        $materias = Materia::with(['planEstudio', 'numeroPeriodo'])->paginate(10);
        return view('materias.index', compact('materias'));
    }

    // Mostrar materias por plan de estudio
    public function materiasPorPlan($id_plan_estudio)
    {
        $plan = PlanEstudio::findOrFail($id_plan_estudio);
        $materias = Materia::with('numeroPeriodo')
            ->where('id_plan_estudio', $id_plan_estudio)
            ->get();

        return view('materias.materias_por_plan', compact('plan', 'materias'));
    }

    // Crear nueva materia
    public function create()
    {
        $planes = PlanEstudio::all();
        $periodos = NumeroPeriodo::all();
        return view('materias.create', compact('planes', 'periodos'));
    }

    // Guardar nueva materia
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'id_plan_estudio' => 'required|integer|exists:planes_estudio,id_plan_estudio',
            'id_numero_periodo' => 'required|integer|exists:numero_periodos,id_numero_periodo',
        ]);

        Materia::create($request->all());

        return redirect()->route('materias.index')->with('success', 'Materia creada correctamente.');
    }

    // Editar materia
    public function edit($id)
    {
        $materia = Materia::findOrFail($id);
        $planes = PlanEstudio::all();
        $periodos = NumeroPeriodo::all();
        return view('materias.edit', compact('materia', 'planes', 'periodos'));
    }

    // Actualizar materia
    public function update(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:150',
            'id_plan_estudio' => 'required|integer|exists:planes_estudio,id_plan_estudio',
            'id_numero_periodo' => 'required|integer|exists:numero_periodos,id_numero_periodo',
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
