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
        Schema::create('diaries', function (Blueprint $table) {
            $table->id();
            $table->string('evento');
            $table->timestamp('fecha')->useCurrent();
            $table->foreignId('enterprise_id')->constrained('enterprises')->onDelete('cascade');
            $table->timestamps();

            // Crear índice en 'empresa_id'
            $table->index('enterprise_id', 'idx_agenda_empresa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diaries');
    }
};
