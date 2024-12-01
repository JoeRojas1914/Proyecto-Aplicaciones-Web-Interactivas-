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
        Schema::create('solicitud', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->binary('file')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud');
    }
};
