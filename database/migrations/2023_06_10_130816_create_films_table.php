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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->boolean('adult')->nullable();
            $table->string('backdrop_path')->nullable();
            $table->unsignedBigInteger('themoviedb_id')->nullable();
            $table->string('title')->nullable();
            $table->string('original_language', 2)->nullable();
            $table->string('original_title')->nullable();
            $table->longText('overview')->nullable();
            $table->string('poster_path')->nullable();
            $table->date('release_date')->nullable();
            $table->boolean('video')->nullable();
            $table->float('vote_average')->nullable();
            $table->integer('vote_count')->nullable();
            $table->unsignedBigInteger('genre_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
