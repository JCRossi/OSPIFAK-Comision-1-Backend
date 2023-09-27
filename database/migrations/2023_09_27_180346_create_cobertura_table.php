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
            $table->string("nombre_prestacion");
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
