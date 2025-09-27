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
        Schema::table('evaluaciones', function (Blueprint $table) {
            $table->foreign(['id_tipo_evaluacion'], 'evaluaciones_ibfk_1')->references(['id_tipo_evaluacion'])->on('tipos_evaluaciones')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_unidad'], 'evaluaciones_ibfk_2')->references(['id_unidad'])->on('unidades')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluaciones', function (Blueprint $table) {
            $table->dropForeign('evaluaciones_ibfk_1');
            $table->dropForeign('evaluaciones_ibfk_2');
        });
    }
};
