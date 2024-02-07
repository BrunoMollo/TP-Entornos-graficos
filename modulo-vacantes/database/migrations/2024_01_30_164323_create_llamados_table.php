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
        Schema::create('llamados', function (Blueprint $table) {
            $table->id();
            $table->string('puesto');
            $table->text('descripcion');
            $table->dateTime('fecha_apertura');
            $table->dateTime('fecha_cierre');
            $table->enum('estado', ['abierto', 'cerrado'])->default('abierto'); 
            $table->foreignId('catedra_id')->constrained('catedras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('llamados');
    }
};
