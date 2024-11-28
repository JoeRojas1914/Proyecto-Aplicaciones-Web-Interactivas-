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
        Schema::create('watch_list', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('movie_id'); // ID de la película de la API
            $table->timestamps();

            // Clave primaria compuesta para evitar duplicados
            $table->primary(['user_id', 'movie_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watch_list');
    }
};
