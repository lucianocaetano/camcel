<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('requested_documents', function (Blueprint $table) {
        $table->id();
        $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade');
        $table->foreignId('enterprise_id')->constrained('enterprises')->onDelete('cascade');
        $table->string('document_type', 50);   // Tipo de documento (ejemplo: cedula, BPS)
        $table->string('title');               // Título del documento solicitado
        $table->boolean('is_uploaded')->default(false); // Indica si ya fue subido
        $table->integer('max_files')->default(1); // Número máximo de archivos
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requested_documents');
    }
};
