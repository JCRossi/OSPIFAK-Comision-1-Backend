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
        Schema::create('cobertura', function (Blueprint $table) {
            $table->id();
            $table->enum('nombre_prestacion', ['Consultas medicas', 'Consultas medicas domiciliarias', 
                'Consulta medica online', 'Internacion','Odontologia general', 'Ortodoncia', 
                'Protesis odontologicas', 'Implantes odontologicos', 'Kinesiologia', 'Psicologia',
                'Medicamentos en farmacia', 'Medicamentos en internacion', 'Optica', 'Cirugias esteticas',
                'Analisis clinicos', 'Analisis de diagnostico']);
            $table->integer("porcentaje");
            $table->integer("id_plan");
            $table->timestamps();

            $table->foreign('id_plan')
                ->references('id')->on('plan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cobertura');
    }
};
