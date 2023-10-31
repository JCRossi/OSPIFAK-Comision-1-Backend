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
        Schema::create('prestaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('cliente_menor_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string("nombre_medico");
            $table->string("matricula_medico");
            $table->string("instituto");
            $table->date("fecha_turno");
            $table->date("fecha_solicitud");
            $table->enum('estado', ['Pendiente, Aceptada, Rechazada']);
            $table->enum('nombre_prestacion', ['Consultas medicas', 'Consultas medicas domiciliarias', 
                'Consulta medica online', 'Internacion','Odontologia general', 'Ortodoncia', 
                'Protesis odontologicas', 'Implantes odontologicos', 'Kinesiologia', 'Psicologia',
                'Medicamentos en farmacia', 'Medicamentos en internacion', 'Optica', 'Cirugias esteticas',
                'Analisis clinicos', 'Analisis de diagnostico']);
            $table->string("comentario")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestaciones');
    }
};
