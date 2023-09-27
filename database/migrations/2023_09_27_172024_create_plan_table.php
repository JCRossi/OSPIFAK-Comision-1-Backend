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
        Schema::create('plan', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            
            $table->float("precio_jovenes"); //-21
            $table->float("precio_adultos_jovenes"); //21-35
            $table->float("precio_adultos"); //35-55
            $table->float("precio_adultos_mayores"); //+55
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan');
    }
};
