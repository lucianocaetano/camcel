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

<<<<<<< HEAD:database/migrations/2024_06_20_114616_create_documentos_table.php
            $table->unsignedBigInteger('operator_id');
            $table->foreign('operator_id')->references('id')->on('operators');
            
=======
            $table->string('operator_id');
            $table->foreign('operator_id')->references('id')->on('operators');

            $table->string('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');

>>>>>>> actividades_calendario:database/migrations/2024_06_20_114616_create_documents_table.php
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
