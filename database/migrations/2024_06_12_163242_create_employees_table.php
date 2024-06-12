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
        // hice una tabla empleados separada de user por que user es para el sistema de 
        // authenticacion y en user solo ban a estar los empleados de camcel que usen este app
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('correo')->unique();
            $table->string('contrasena');
            //no se que rol poner solo para empleados
            $table->enum('rol', ['Usuario', 'Operario']);
            $table->foreignId('enterprise_id')->nullable()->constrained('enterprises')->onDelete('set null');
            $table->timestamps();

            // Crear índice en 'empresa_id'
            $table->index('enterprise_id', 'idx_empleado_empresa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
