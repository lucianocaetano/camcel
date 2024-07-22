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
        Schema::create('operators', function (Blueprint $table) {
            $table->string("cedula")->primary();
            $table->string("nombre");
            $table->boolean("autorizado");

            $table->string('RUT_enterprise');
            $table->foreign('RUT_enterprise')->references('RUT')->on('enterprises');

            $table->string("cargo");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operators');
    }
};
