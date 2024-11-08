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
        Schema::create('job_dates', function (Blueprint $table) {
            $table->id();

            $table->json('fecha');
            $table->time('hora_entrada')->nullable(); // Agregar esta línea
            $table->time('hora_salida')->nullable(); // Agregar esta línea

            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_dates');
    }
};
