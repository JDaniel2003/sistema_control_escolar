<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materias';
    protected $primaryKey = 'id_materia';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'clave',
        'id_tipo_competencia',
        'id_modalidad',
        'creditos',
        'horas',
        'id_espacio_formativo',
        'id_plan_estudio',
        'id_numero_periodo',
        'datos'
    ];

    protected $casts = [
        'datos' => 'array'
    ];

    // Relación: una materia pertenece a un plan de estudio
    public function planEstudio()
    {
        return $this->belongsTo(PlanEstudio::class, 'id_plan_estudio', 'id_plan_estudio');
    }

    // Relación: una materia pertenece a un número de periodo
    public function numeroPeriodo()
    {
        return $this->belongsTo(NumeroPeriodo::class, 'id_numero_periodo', 'id_numero_periodo');
    }

    public function competencia()
    {
        return $this->belongsTo(Competencia::class, 'id_tipo_competencia', 'id_tipo_competencia');
    }
    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class, 'id_modalidad', 'id_modalidad');
    }
    public function espacioFormativo()
    {
        return $this->belongsTo(EspacioFormativo::class, 'id_espacio_formativo', 'id_espacio_formativo');
    }




    public function unidades()
{
    return $this->hasMany(Unidad::class, 'id_materia');
}


    
}
