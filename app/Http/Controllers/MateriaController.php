<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use App\Models\EspacioFormativo;
use App\Models\Materia;
use App\Models\Modalidad;
use App\Models\PlanEstudio;
use App\Models\NumeroPeriodo;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    // Mostrar todas las materias
    public function index(Request $request)
    {
        $query = Materia::with([
        'planEstudio',
        'numeroPeriodo.tipoPeriodo',
        'competencia',
        'modalidad',
        'espacioFormativo'
    ]);

        if ($request->filled('nombre')) {
        $query->where('nombre', 'like', '%' . $request->nombre . '%');
    }
    if ($request->filled('clave')) {
        $query->where('clave', 'like', '%' . $request->clave . '%');
    }
     if ($request->filled('id_tipo_competencia')) {
        $query->where('id_tipo_competencia', $request->id_tipo_competencia);
    }
    if ($request->filled('id_modalidad')) {
        $query->where('id_modalidad', $request->id_modalidad);
    }
    if ($request->filled('id_espacio_formativo')) {
        $query->where('id_espacio_formativo', $request->id_espacio_formativo);
    }

    if ($request->filled('id_plan_estudio')) {
        $query->where('id_plan_estudio', $request->id_plan_estudio);
    }

    if ($request->filled('id_numero_periodo')) {
        $query->where('id_numero_periodo', $request->id_numero_periodo);
    }

    // PAGINACIÓN
     $mostrar = $request->get('mostrar', 10); // por defecto 10

        if ($mostrar === "todo") {
            $materias = $query->orderBy('id_materia', 'desc')->get();
        } else {
            $materias = $query->orderBy('id_materia', 'desc')->paginate((int)$mostrar);
        }


        $planes = PlanEstudio::all();
        $periodos = NumeroPeriodo::with('tipoPeriodo')->get();
        $competencias = Competencia::all();
        $modalidades = Modalidad::all();
        $espaciosformativos = EspacioFormativo::all();



        return view('materias.materias', compact('materias', 'planes', 'periodos', 'competencias', 'modalidades', 'espaciosformativos'));
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
        $competencias = Competencia::all();
        $modalidades = Modalidad::all();
        $espaciosformativos = EspacioFormativo::all();
        $planes = PlanEstudio::all();
        $periodos = NumeroPeriodo::all();
        return view('materias.create', compact('competencias', 'modalidades', 'espaciosformativos', 'planes', 'periodos'));
    }

    // Guardar nueva materia
    public function store(Request $request)
    {
        $request->validate([
            'clave',
            'nombre' => 'required|string|max:150',
            'id_tipo_competencia' => 'required|integer|exists:tipos_competencia,id_tipo_competencia',
            'id_modalidad' => 'required|integer|exists:modalidades,id_modalidad',
            'creditos',
            'horas',
            'id_espacio_formativo' => 'required|integer|exists:espacios_formativos,id_espacio_formativo',
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
