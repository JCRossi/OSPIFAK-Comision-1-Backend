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
        Schema::create('solicitudes_baja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('paciente_id');
            $table->enum('paciente_tipo', ['titular', 'menor']);
            $table->enum('estado', ['Pendiente', 'Aceptada', 'Rechazada']);
            $table->string('comentarios')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_baja');
    }
};
