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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string("usuario");
            $table->string("password");
            $table->string("nombre");
            $table->string("apellido");
            $table->date("fecha_nacimiento");
            $table->integer("dni")->unique();
            $table->string("email");
            $table->string("direccion");
            $table->enum('estado', ['Activo', 'Inactivo']);
            $table->integer("telefono");
            $table->foreignId('plan_id')->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->timestamps();
            $table->enum('forma_pago', ['Mensual', 'Anual', 'Semestral']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
