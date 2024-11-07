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
            $table->boolean("is_check")->default(false);
            $table->boolean("is_check_enterprise")->default(false);
            $table->time("hora_entrada");
            $table->time("hora_salida");

            $table->boolean("confirmacion_prevencionista")->default(false);
            $table->boolean("confirmacion_empresa")->default(false);

            $table->unsignedBigInteger('enterprise_id')->nullable();
            $table->foreign('enterprise_id')->references('id')->on('enterprises')->onDelete('cascade');

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
