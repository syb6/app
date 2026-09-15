<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->date('birthday');
            $table->string('favorite_color');
            $table->string('favorite_food');
            $table->string('favorite_movie');
            $table->string('favorite_song');
            $table->text('favorite_memory');
            $table->string('favorite_place');
            $table->string('favorite_snack');
            $table->string('dream_destination');
            $table->text('anything_else')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};