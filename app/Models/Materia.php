<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materias';
    protected $primaryKey = 'id_materia';
    public $timestamps = false; // tu tabla no tiene created_at ni updated_at

    protected $fillable = [
        'nombre',
        'id_tipo_competencia',
        'id_modalidad',
        'creditos',
        'horas',
        'id_espacio_formativo',
        'id_plan_estudio',
        'datos',
    ];

    // Relación: una materia pertenece a un plan de estudio
    public function plan()
    {
        return $this->belongsTo(PlanEstudio::class, 'id_plan_estudio', 'id_plan_estudio');
    }
}
