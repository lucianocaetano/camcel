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
        Schema::create('income_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('enterprise_id')->constrained('enterprises')->onDelete('cascade');
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();

            // Crear índices en 'usuario_id' y 'empresa_id'
            $table->index('employee_id', 'idx_registro_ingresos_usuario_id');
            $table->index('enterprise_id', 'idx_registro_ingresos_empresa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_records');
    }
};
