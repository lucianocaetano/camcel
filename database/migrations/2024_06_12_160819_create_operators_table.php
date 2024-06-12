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
            $table->integer('CI')->primary()->unique();
            $table->string('nombre');
            $table->foreignId('enterprise_id')->nullable()->constrained('enterprises')->onDelete('set null');
            $table->timestamps();
            
            $table->index('enterprise_id', 'idx_operarios_empresa_id');
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
