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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            $table->string("trabajo");
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->time("hora_entrada");
            $table->time("hora_salida");
            $table->boolean("confirmacion_prevencionista")->default(false);
            $table->boolean("confirmacion_empresa")->default(false);

            $table->foreign('empresa_id')->references('id')->on('enterprises')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
