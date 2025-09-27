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
        Schema::create('status_academico', function (Blueprint $table) {
            $table->integer('id_status_academico', true);
            $table->integer('id_tipo_status_academico')->nullable()->index('id_tipo_status_academico');
            $table->string('descripcion', 100)->nullable();
            $table->json('datos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_academico');
    }
};
