<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('calificaciones', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_calificaciones_alumno')->references(['id_alumno'])->on('alumnos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_asignacion'], 'fk_calificaciones_asignacion')->references(['id_asignacion'])->on('asignaciones_docentes')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_evaluacion'], 'fk_calificaciones_evaluacion')->references(['id_evaluacion'])->on('evaluaciones')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_materia'], 'fk_calificaciones_materia')->references(['id_materia'])->on('materias')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calificaciones', function (Blueprint $table) {
            $table->dropForeign('fk_calificaciones_alumno');
            $table->dropForeign('fk_calificaciones_asignacion');
            $table->dropForeign('fk_calificaciones_evaluacion');
            $table->dropForeign('fk_calificaciones_materia');
        });
    }
};
