<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\AreaEspecializacion;
use App\Models\Beca;
use App\Models\Carrera;
use App\Models\StatusAcademico;
use Illuminate\Http\Request;
use App\Models\TipoSangre;
use App\Models\EstadoCivil;
use App\Models\Genero;
use App\Models\LenguaIndigena;
use App\Models\Discapacidad;
use App\Models\Distrito;
use App\Models\EscuelaProcedencia;
use App\Models\Tutor;
use App\Models\DomicilioAlumno;
use App\Models\DomicilioTutor;
use App\Models\Estado;
use App\Models\Generacion;
use App\Models\Parentesco;
use App\Models\PlanEstudio;
use App\Models\Subsistema;
use App\Models\TipoEscuela;

class AlumnoController extends Controller
{
    /**
     * Mostrar listado de alumnos con sus datos personales y académicos
     */
    public function index()
{
    $alumnos = Alumno::with(['datosPersonales', 'datosAcademicos', 'statusAcademico'])->get();
    $estatus = StatusAcademico::all();
    $generaciones = Generacion::all();
    $carreras = Carrera::all();
    $planes = PlanEstudio::all();
    $tipos_sangre = TipoSangre::all();
    $estados_civiles = EstadoCivil::all();
    $generos = Genero::all();
    $lenguas = LenguaIndigena::all();
    $discapacidades = Discapacidad::all();
    $domicilios = DomicilioAlumno::with(['distritos','estados']);
    
    $escuelas = EscuelaProcedencia::with(['areaEspecializacion', 'subsistemas', 'estados', 'becas', 'tiposEscuela'])->get();
    $subsistemas = Subsistema::all(); 
    $areaEspecializacion = AreaEspecializacion::all(); 
    $estados = Estado::all(); 
    $distritos = Distrito::all();
    $becas = Beca::all();
    $tiposEscuela = TipoEscuela::all();
    $tutores = Tutor::with(['parentescos']);
    $domiciliosTutor = DomicilioTutor::with(['distritos','estados']);
    $parentescos=Parentesco::all();

    return view('alumnos.alumnos', compact(
        'alumnos',
        'estatus',
        'carreras',
        'planes',
        'tipos_sangre',
        'estados_civiles',
        'generos',
        'lenguas',
        'discapacidades',
        'escuelas',
        'tutores',
        'domicilios',
        'subsistemas',
        'areaEspecializacion',
        'estados',
        'becas',
        'tiposEscuela',
        'parentescos',
        'distritos',
        'generaciones'

    ));
}

    public function create()
{
    $alumnos = \App\Models\Alumno::all();
    $estatus = \App\Models\StatusAcademico::all();
    return view('alumnos.create', compact('alumnos', 'estatus'));
}

public function store(Request $request)
{
    // 🔹 Crear domicilio del alumno
    $domicilioAlumno = \App\Models\DomicilioAlumno::create([
        'calle' => $request->domicilio_alumno['calle'] ?? null,
        'numero_exterior' => $request->domicilio_alumno['numero_exterior'] ?? null,
        'numero_interior' => $request->domicilio_alumno['numero_interior'] ?? null,
        'colonia' => $request->domicilio_alumno['colonia'] ?? null,
        'comunidad' => $request->domicilio_alumno['comunidad'] ?? null,
        'id_distrito' => $request->domicilio_alumno['id_distrito'] ?? null,
        'id_estado' => $request->domicilio_alumno['id_estado'] ?? null,
        'municipio' => $request->domicilio_alumno['municipio'] ?? null,
        'codigo_postal' => $request->codigo_postal ?? null,
    ]);

    // 🔹 Crear escuela de procedencia
    $escuelaProcedencia = \App\Models\EscuelaProcedencia::create([
        'id_subsistema' => $request->id_subsistema ?? null,
        'id_tipo_escuela' => $request->id_tipo_escuela ?? null,
        'id_area_especializacion' => $request->id_area_especializacion ?? null,
        'id_estado' => $request->escuela['id_estado'] ?? null,
        'localidad' => $request->escuela['localidad'] ?? null,
        'id_beca' => $request->id_beca ?? null,
        'promedio_egreso' => $request->promedio_egreso ?? null,
    ]);

    // 🔹 Crear domicilio del tutor
    $domicilioTutor = \App\Models\DomicilioTutor::create([
        'calle' => $request->domicilio_tutor['calle'] ?? null,
        'numero_exterior' => $request->domicilio_tutor['numero_exterior'] ?? null,
        'numero_interior' => $request->domicilio_tutor['numero_interior'] ?? null,
        'colonia' => $request->domicilio_tutor['colonia'] ?? null,
        'municipio' => $request->domicilio_tutor['municipio'] ?? null,
        'id_distrito' => $request->domicilio_tutor['id_distrito'] ?? null,
        'id_estado' => $request->domicilio_tutor['id_estado'] ?? null,
    ]);

    // 🔹 Crear tutor
    $tutor = \App\Models\Tutor::create([
        'nombres' => $request->tutor['nombres'] ?? null,
        'id_parentesco' => $request->id_parentesco ?? null,
        'telefono' => $request->tutor['telefono'] ?? null,
        'id_domicilio_tutor' => $domicilioTutor->id_domicilio_tutor,
    ]);

    // 🔹 Crear datos personales del alumno (ahora ya tenemos el tutor creado)
    $datosPersonales = \App\Models\DatosPersonales::create([
        'nombres' => $request->datos_personales['nombres'] ?? null,
        'primer_apellido' => $request->datos_personales['primer_apellido'] ?? null,
        'segundo_apellido' => $request->datos_personales['segundo_apellido'] ?? null,
        'telefono' => $request->datos_personales['telefono'] ?? $request->telefono ?? null,
        'curp' => $request->curp ?? null,
        'correo' => $request->correo ?? null,
        'fecha_nacimiento' => $request->fecha_nacimiento ?? null,
        'edad' => $request->edad ?? null,
        'lugar_nacimiento' => $request->lugar_nacimiento ?? null,
        'id_estado_civil' => $request->id_estado_civil ?? null,
        'id_tipo_sangre' => $request->id_tipo_sangre ?? null,
        'id_lengua_indigena' => $request->id_lengua_indigena ?? null,
        'id_discapacidad' => $request->id_discapacidad ?? null,
        'id_genero' => $request->id_genero ?? null,
        'numero_seguridad_social' => $request->numero_seguridad_social ?? null,
        'hijos' => $request->hijos ?? 0,
        'id_domicilio_alumno' => $domicilioAlumno->id_domicilio_alumno,
        'id_datos_escuela_procedencia' => $escuelaProcedencia->id_datos_escuela_procedencia,
        'id_datos_tutor' => $tutor->id_datos_tutor, 
    ]);

    // 🔹 Crear datos académicos (si aplica)
    $datosAcademicos = null;
    if ($request->filled('matricula') && $request->filled('id_carrera')) {
        $datosAcademicos = \App\Models\DatosAcademicos::create([
            'matricula' => $request->matricula,
            'id_carrera' => $request->id_carrera,
            'id_plan_estudio' => $request->id_plan_estudio ?? null,
            'semestre' => $request->semestre ?? null,
        ]);
    }

    // 🔹 Crear alumno principal
    $alumno = \App\Models\Alumno::create([
        'id_datos_personales' => $datosPersonales->id_datos_personales,
        'id_datos_academicos' => $datosAcademicos?->id_datos_academicos,
        'id_status_academico' => $request->id_status_academico ?? null,
        'id_generacion' => $request->id_generacion ?? null,
        'id_datos_tutor' => $tutor->id_datos_tutor,
        'servicios_social' => $request->servicios_social ?? null,
    ]);

    return redirect()->route('alumnos.index')
                     ->with('success', 'Alumno agregado correctamente.');
}








    /**
     * Mostrar información de un solo alumno
     */
   public function show($id)
{
    $alumno = Alumno::with([
        'datosPersonales',
        'datosPersonales.estadoCivil',
        'datosPersonales.tipoSangre',
        'datosPersonales.genero',
        'datosPersonales.lenguaIndigena',
        'datosPersonales.discapacidad',
        'datosPersonales.domicilioAlumno.distritos',
        'datosPersonales.domicilioAlumno.estados',
        'datosAcademicos.carrera',
        'statusAcademico',
        'generaciones',
        'tutor',
        'tutor.parentescos',
        'tutor.domiciliosTutor.distritos',
        'tutor.domiciliosTutor.estados',
        'escuelaProcedencia.estado',
        'escuelaProcedencia.tipoEscuela',
        'escuelaProcedencia.subsistema'
    ])->findOrFail($id);

    return view('alumnos.show', compact('alumno'));
}

/**
 * Actualizar información del alumno
 */
public function update(Request $request, $id)
{
    // Buscar el alumno
    $alumno = Alumno::findOrFail($id);

    // 🔹 Actualizar domicilio del alumno
    if ($alumno->datosPersonales && $alumno->datosPersonales->domicilioAlumno) {
        $alumno->datosPersonales->domicilioAlumno->update([
            'calle' => $request->domicilio_alumno['calle'] ?? null,
            'numero_exterior' => $request->domicilio_alumno['numero_exterior'] ?? null,
            'numero_interior' => $request->domicilio_alumno['numero_interior'] ?? null,
            'colonia' => $request->domicilio_alumno['colonia'] ?? null,
            'comunidad' => $request->domicilio_alumno['comunidad'] ?? null,
            'id_distrito' => $request->domicilio_alumno['id_distrito'] ?? null,
            'id_estado' => $request->domicilio_alumno['id_estado'] ?? null,
            'municipio' => $request->domicilio_alumno['municipio'] ?? null,
            'codigo_postal' => $request->codigo_postal ?? null,
        ]);
    } else {
        // Crear domicilio si no existe
        $domicilioAlumno = DomicilioAlumno::create([
            'calle' => $request->domicilio_alumno['calle'] ?? null,
            'numero_exterior' => $request->domicilio_alumno['numero_exterior'] ?? null,
            'numero_interior' => $request->domicilio_alumno['numero_interior'] ?? null,
            'colonia' => $request->domicilio_alumno['colonia'] ?? null,
            'comunidad' => $request->domicilio_alumno['comunidad'] ?? null,
            'id_distrito' => $request->domicilio_alumno['id_distrito'] ?? null,
            'id_estado' => $request->domicilio_alumno['id_estado'] ?? null,
            'municipio' => $request->domicilio_alumno['municipio'] ?? null,
            'codigo_postal' => $request->codigo_postal ?? null,
        ]);
        
        if ($alumno->datosPersonales) {
            $alumno->datosPersonales->update([
                'id_domicilio_alumno' => $domicilioAlumno->id_domicilio_alumno
            ]);
        }
    }

    // 🔹 Actualizar datos personales del alumno
    if ($alumno->datosPersonales) {
        $alumno->datosPersonales->update([
            'nombres' => $request->datos_personales['nombres'] ?? null,
            'primer_apellido' => $request->datos_personales['primer_apellido'] ?? null,
            'segundo_apellido' => $request->datos_personales['segundo_apellido'] ?? null,
            'telefono' => $request->telefono ?? null,
            'curp' => $request->curp ?? null,
            'correo' => $request->correo ?? null,
            'fecha_nacimiento' => $request->fecha_nacimiento ?? null,
            'edad' => $request->edad ?? null,
            'lugar_nacimiento' => $request->lugar_nacimiento ?? null,
            'id_estado_civil' => $request->id_estado_civil ?? null,
            'id_tipo_sangre' => $request->id_tipo_sangre ?? null,
            'id_lengua_indigena' => $request->id_lengua_indigena ?? null,
            'id_discapacidad' => $request->id_discapacidad ?? null,
            'id_genero' => $request->id_genero ?? null,
            'numero_seguridad_social' => $request->numero_seguridad_social ?? null,
            'hijos' => $request->hijos ?? 0,
        ]);
    }

    // 🔹 Actualizar domicilio del tutor
    if ($alumno->tutor && $alumno->tutor->domiciliosTutor) {
        $alumno->tutor->domiciliosTutor->update([
            'calle' => $request->domicilio_tutor['calle'] ?? null,
            'numero_exterior' => $request->domicilio_tutor['numero_exterior'] ?? null,
            'numero_interior' => $request->domicilio_tutor['numero_interior'] ?? null,
            'colonia' => $request->domicilio_tutor['colonia'] ?? null,
            'municipio' => $request->domicilio_tutor['municipio'] ?? null,
            'id_distrito' => $request->domicilio_tutor['id_distrito'] ?? null,
            'id_estado' => $request->domicilio_tutor['id_estado'] ?? null,
        ]);
    } else if ($alumno->tutor && $request->filled('domicilio_tutor')) {
        // Crear domicilio del tutor si no existe
        $domicilioTutor = DomicilioTutor::create([
            'calle' => $request->domicilio_tutor['calle'] ?? null,
            'numero_exterior' => $request->domicilio_tutor['numero_exterior'] ?? null,
            'numero_interior' => $request->domicilio_tutor['numero_interior'] ?? null,
            'colonia' => $request->domicilio_tutor['colonia'] ?? null,
            'municipio' => $request->domicilio_tutor['municipio'] ?? null,
            'id_distrito' => $request->domicilio_tutor['id_distrito'] ?? null,
            'id_estado' => $request->domicilio_tutor['id_estado'] ?? null,
        ]);
        
        $alumno->tutor->update([
            'id_domicilio_tutor' => $domicilioTutor->id_domicilio_tutor
        ]);
    }

    // 🔹 Actualizar datos del tutor
    if ($alumno->tutor) {
        $alumno->tutor->update([
            'nombres' => $request->tutor['nombres'] ?? null,
            'id_parentesco' => $request->id_parentesco ?? null,
            'telefono' => $request->tutor['telefono'] ?? null,
        ]);
    } else if ($request->filled('tutor')) {
        // Crear tutor si no existe
        $domicilioTutor = DomicilioTutor::create([
            'calle' => $request->domicilio_tutor['calle'] ?? null,
            'numero_exterior' => $request->domicilio_tutor['numero_exterior'] ?? null,
            'numero_interior' => $request->domicilio_tutor['numero_interior'] ?? null,
            'colonia' => $request->domicilio_tutor['colonia'] ?? null,
            'municipio' => $request->domicilio_tutor['municipio'] ?? null,
            'id_distrito' => $request->domicilio_tutor['id_distrito'] ?? null,
            'id_estado' => $request->domicilio_tutor['id_estado'] ?? null,
        ]);

        $tutor = Tutor::create([
            'nombres' => $request->tutor['nombres'] ?? null,
            'id_parentesco' => $request->id_parentesco ?? null,
            'telefono' => $request->tutor['telefono'] ?? null,
            'id_domicilio_tutor' => $domicilioTutor->id_domicilio_tutor,
        ]);

        $alumno->update([
            'id_datos_tutor' => $tutor->id_datos_tutor
        ]);
    }

    // 🔹 Actualizar o crear datos académicos
    if ($request->filled('matricula') && $request->filled('id_carrera')) {
        if ($alumno->datosAcademicos) {
            $alumno->datosAcademicos->update([
                'matricula' => $request->matricula,
                'id_carrera' => $request->id_carrera,
                'id_plan_estudio' => $request->id_plan_estudio ?? null,
                'semestre' => $request->semestre ?? null,
            ]);
        } else {
            // Crear datos académicos si no existen
            $datosAcademicos = \App\Models\DatosAcademicos::create([
                'matricula' => $request->matricula,
                'id_carrera' => $request->id_carrera,
                'id_plan_estudio' => $request->id_plan_estudio ?? null,
                'semestre' => $request->semestre ?? null,
            ]);

            $alumno->update([
                'id_datos_academicos' => $datosAcademicos->id_datos_academicos
            ]);
        }
    }

    // 🔹 Actualizar datos del alumno principal
    $alumno->update([
        'id_status_academico' => $request->id_status_academico ?? $alumno->id_status_academico,
        'id_generacion' => $request->id_generacion ?? $alumno->id_generacion,
        'servicios_social' => $request->servicios_social ?? $alumno->servicios_social,
    ]);

    return redirect()->route('alumnos.index')
                     ->with('success', 'Alumno actualizado correctamente.');
}

/**
 * Eliminar un alumno
 */
public function destroy($id)
{
    $alumno = Alumno::findOrFail($id);
    
    // Eliminar registros relacionados si es necesario
    // (dependiendo de tu configuración de cascada en la BD)
    
    $alumno->delete();
    
    return redirect()->route('alumnos.index')
                     ->with('success', 'Alumno eliminado correctamente.');
}


}
