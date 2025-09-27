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
        Schema::table('historial_status', function (Blueprint $table) {
            $table->foreign(['id_tipo_status'], 'historial_status_ibfk_1')->references(['id_tipo_status'])->on('tipos_status')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_status', function (Blueprint $table) {
            $table->dropForeign('historial_status_ibfk_1');
        });
    }
};
