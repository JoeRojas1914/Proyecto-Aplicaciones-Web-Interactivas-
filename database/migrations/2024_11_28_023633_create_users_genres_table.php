<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // TABLA DE PREFERENCIAS DE GÉNEROS DE PELÍCULAS DE LOS USUARIOS (TERROR, COMEDIA, ETC.)
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_genres', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('genre_id'); // ID del género de películas de la API
            $table->timestamps();

            // Clave primaria compuesta para evitar duplicados
            $table->primary(['user_id', 'genre_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_genres');
    }
};
