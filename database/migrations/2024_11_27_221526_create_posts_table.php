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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('movie_id'); // Película a la que pertenece la reseña
            // $table->text('movie_title'); // Título de la reseña
            $table->text('content'); // Contenido de las reseñas
            $table->integer('likes')->default(0); // Número de likes
            $table->integer('dislikes')->default(0); // Número de dislikes
            $table->integer('rating')->default(0); // Puntuación de la reseña
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
