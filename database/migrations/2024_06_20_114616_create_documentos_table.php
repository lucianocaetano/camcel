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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string("url_document");
            $table->datetime("expira");
            $table->boolean("autorizado");

            $table->unsignedBigInteger('operator_id')->nulleable();
            $table->foreign('operator_id')->references('id')->on('operators');
 
            $table->unsignedBigInteger('enterprise_id')->nulleable();
            $table->foreign('enterprise_id')->references('id')->on('enterprises');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};