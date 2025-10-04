<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use App\Models\Materia;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    /**
     * Mostrar listado de unidades (puedes adaptarlo según materia).
     */
    public function index()
    {
        $unidades = Unidad::with('materia')->get();
        return view('unidades.index', compact('unidades'));
    }

    /**
     * Mostrar formulario para crear una nueva unidad.
     */
    public function create($id_materia = null)
    {
        $materias = Materia::all();
        return view('unidades.create', compact('materias', 'id_materia'));
    }

    /**
     * Guardar nueva unidad en BD.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'numero_unidad' => 'required|integer',
            'horas_saber' => 'nullable|integer',
            'horas_saber_hacer' => 'nullable|integer',
            'horas_totales' => 'nullable|integer',
            'id_materia' => 'required|exists:materias,id_materia',
        ]);

        Unidad::create($request->all());

        return redirect()->route('materias.show', $request->id_materia)
                         ->with('success', 'Unidad agregada correctamente');
    }

    /**
     * Mostrar formulario de edición de unidad.
     */
    public function edit($id)
    {
        $unidad = Unidad::findOrFail($id);
        $materias = Materia::all();
        return view('unidades.edit', compact('unidad', 'materias'));
    }

    public function actualizarTodo(Request $request, $idMateria)
{
    foreach ($request->unidades as $unidadData) {
        $unidad = Unidad::find($unidadData['id_unidad']);
        if ($unidad) {
            $unidad->update([
                'numero_unidad'     => $unidadData['numero_unidad'],
                'nombre'            => $unidadData['nombre'],
                'horas_saber'       => $unidadData['horas_saber'],
                'horas_saber_hacer' => $unidadData['horas_saber_hacer'],
                'horas_totales'     => $unidadData['horas_totales'],
            ]);
        }
    }

    return back()->with('success', 'Unidades actualizadas correctamente.');
}

    /**
     * Actualizar unidad en BD.
     */
    public function update(Request $request, $id)
    {
        $unidad = Unidad::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'numero_unidad' => 'required|integer',
            'horas_saber' => 'nullable|integer',
            'horas_saber_hacer' => 'nullable|integer',
            'horas_totales' => 'nullable|integer',
            'id_materia' => 'required|exists:materias,id_materia',
        ]);

        $unidad->update($request->all());

        return redirect()->route('materias.show', $unidad->id_materia)
                         ->with('success', 'Unidad actualizada correctamente');
    }

    /**
     * Eliminar unidad.
     */
    public function destroy($id)
    {
        $unidad = Unidad::findOrFail($id);
        $materiaId = $unidad->id_materia;

        $unidad->delete();

        return redirect()->route('materias.show', $materiaId)
                         ->with('success', 'Unidad eliminada correctamente');
    }
}
