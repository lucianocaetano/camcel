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

            $table->string("description");
            $table->string("is_check");
            $table->string("is_check_enterprise");

            $table->date("date");
            $table->time("in_time");
            $table->time("out_time");

            $table->string('RUT_enterprise');
            $table->foreign('RUT_enterprise')->references('RUT')->on('enterprises');

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
