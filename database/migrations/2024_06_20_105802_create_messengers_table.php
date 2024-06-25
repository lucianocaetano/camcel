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
        Schema::create('messengers', function (Blueprint $table) {
            $table->id();
            $table->date("fecha");
            $table->text("texto");
            
            $table->unsignedBigInteger('remitente');
            $table->foreign('remitente')->references('id')->on('users');
            
            $table->unsignedBigInteger('destinatario');
            $table->foreign('destinatario')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messengers');
    }
};
