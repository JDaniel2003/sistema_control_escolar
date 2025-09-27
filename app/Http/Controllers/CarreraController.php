<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public function index()
    {
        $carreras = Carrera::all();
        return view('carreras.carreras', compact('carreras'));

    }

    public function create()
    {
        return view('carreras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'duracion' => 'nullable|string|max:10',
            'datos' => 'nullable|json',
        ]);

        Carrera::create($request->all());

        return redirect()->route('carreras.index')
                         ->with('success', 'Carrera creada correctamente.');
    }

    public function edit(Carrera $carrera)
    {
        return view('carreras.edit', compact('carrera'));
    }

    public function update(Request $request, Carrera $carrera)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'duracion' => 'nullable|string|max:10',
            'datos' => 'nullable|json',
        ]);

        $carrera->update($request->all());

        return redirect()->route('carreras.index')
                         ->with('success', 'Carrera actualizada correctamente.');
    }

    public function destroy(Carrera $carrera)
    {
        $carrera->delete();
        return redirect()->route('carreras.index')
                         ->with('success', 'Carrera eliminada correctamente.');
    }
}
