<?php

namespace App\Http\Controllers;

use App\Models\PeriodoEscolar;
use App\Models\TipoPeriodo;
use Illuminate\Http\Request;

class PeriodoEscolarController extends Controller
{
    public function index(Request $request)
    {
        $query = PeriodoEscolar::with('tipoPeriodo');

        // Filtro por nombre
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Filtro por fechas
        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha_inicio', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha_fin', '<=', $request->fecha_fin);
        }

        // Filtro por tipo de período
        if ($request->filled('id_tipo_periodo')) {
            $query->where('id_tipo_periodo', $request->id_tipo_periodo);
        }

        // Orden fijo (por fecha_inicio orden)
        //$periodos = $query->orderBy('fecha_inicio', 'orden')->paginate(10);
        $mostrar = $request->get('mostrar', 10); // por defecto 10

    if ($mostrar === "todo") {
        $periodos = $query->orderBy('id_periodo_escolar', 'desc')->get();
    } else {
        $periodos = $query->orderBy('id_periodo_escolar', 'desc')->paginate((int)$mostrar);
    }

        // Para llenar el select de tipos
        $tipos = TipoPeriodo::all();

        return view('layouts.periodos', compact('periodos', 'tipos'));
    }

    public function create()
    {
        return view('periodos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
    'nombre' => [
        'required',
        'string',
        'max:255',
        'unique:periodos_escolares,nombre',
        // 🔹 Obliga a tener al menos un guion en medio
        'regex:/^[A-Za-z0-9]+-[A-Za-z0-9]+$/',
    ],
    'fecha_inicio' => 'required|date',
    'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    'estado' => 'required|in:Abierto,Cerrado',
], [
    // 🔹 Mensajes personalizados
    'nombre.unique' => 'El nombre del período ya existe.',
    'nombre.regex'  => 'El nombre debe contener un guion en medio (ejemplo: 2025-1).',
    'nombre.required' => 'El campo nombre es obligatorio.',
]);

        PeriodoEscolar::create($request->all());

        return redirect()->route('periodos.index')
            ->with('success', 'Período escolar creado correctamente.');
    }

    public function edit($id)
    {
        $periodo = PeriodoEscolar::findOrFail($id);
        return view('periodos.edit', compact('periodo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:Abierto,Cerrado',
        ]);

        $periodo = PeriodoEscolar::findOrFail($id);
        $periodo->update($request->all());

        return redirect()->route('periodos.index')
            ->with('success', 'Período escolar actualizado correctamente.');
    }

    public function destroy($id)
    {
        $periodo = PeriodoEscolar::findOrFail($id);
        $periodo->delete();

        return redirect()->route('periodos.index')
            ->with('success', 'Período escolar eliminado correctamente.');
    }
}
