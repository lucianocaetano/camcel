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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo', 50)->nullable();
            $table->text('contenido')->nullable();
            $table->integer('operario_CI')->nullable();
            $table->foreignId('enterprise_id')->constrained('enterprises')->onDelete('cascade');
            $table->timestamp('fecha')->useCurrent();

            $table->foreign('operator_CI')->references('CI')->on('operators')->onDelete('set null');

            // Crear índices en 'operario_CI' y 'empresa_id'
            $table->index('operator_CI', 'idx_documentos_operario_CI');
            $table->index('enterprise_id', 'idx_documentos_empresa_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
