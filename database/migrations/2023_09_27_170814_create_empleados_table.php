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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string("usuario");
            $table->string("password");
            $table->string("nombre");
            $table->string("apellido");
            $table->date("fecha_nacimiento");
            $table->integer("dni")->unique();
            $table->string("email");
            $table->string("direccion");
            $table->bigInteger("telefono");
            $table->date("fecha_ingreso");
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
