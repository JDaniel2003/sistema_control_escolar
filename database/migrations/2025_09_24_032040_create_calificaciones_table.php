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
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->integer('id_calificacion', true);
            $table->decimal('calificacion', 4)->nullable();
            $table->integer('id_evaluacion')->nullable()->index('fk_calificaciones_evaluacion');
            $table->integer('id_alumno')->nullable()->index('fk_calificaciones_alumno');
            $table->integer('id_asignacion')->nullable()->index('fk_calificaciones_asignacion');
            $table->integer('id_materia')->nullable()->index('fk_calificaciones_materia');
            $table->date('fecha')->nullable();
            $table->json('datos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};
