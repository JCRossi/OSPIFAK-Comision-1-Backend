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
        Schema::create('reintegros', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');


            $table->foreignId('medico_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->string("nombre_instituto");

            $table->date("fecha_solicitud");

            $table->string("cbu");

            $table->string('orden_medica');

            $table->string('factura');
            
            $table->enum('tipo_reintegro', ['insumo', 'estudio']);

            $table->string('estado');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reintegros');
    }
};