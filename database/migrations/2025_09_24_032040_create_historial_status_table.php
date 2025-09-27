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
        Schema::create('historial_status', function (Blueprint $table) {
            $table->integer('id_historial_status', true);
            $table->integer('id_tipo_status')->nullable()->index('id_tipo_status');
            $table->boolean('incorporacion')->nullable();
            $table->json('datos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_status');
    }
};
