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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('anime_id');
            $table->string('title');
            $table->string('image_url')->nullable();
            $table->string('type')->nullable();
            $table->float('score')->nullable();
            $table->string('year')->nullable();
            $table->string('item_type')->default('anime'); // 'anime' or 'manga'
            $table->timestamps();

            $table->unique(['user_id', 'anime_id', 'item_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
