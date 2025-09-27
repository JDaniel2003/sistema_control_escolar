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
        Schema::table('status_academico', function (Blueprint $table) {
            $table->foreign(['id_tipo_status_academico'], 'status_academico_ibfk_1')->references(['id_tipo_status_academico'])->on('tipos_status_academico')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status_academico', function (Blueprint $table) {
            $table->dropForeign('status_academico_ibfk_1');
        });
    }
};
