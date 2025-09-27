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
        Schema::table('unidades', function (Blueprint $table) {
            $table->foreign(['id_materia'], 'unidades_ibfk_1')->references(['id_materia'])->on('materias')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_numero_unidad'], 'unidades_ibfk_2')->references(['id_numero_unidad'])->on('numero_unidades')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unidades', function (Blueprint $table) {
            $table->dropForeign('unidades_ibfk_1');
            $table->dropForeign('unidades_ibfk_2');
        });
    }
};
