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
        Schema::create('diary_segments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diary_id');
            $table->string('content', 10000);
            $table->string('meal_time', 10);
            $table->timestamps();

            $table->foreign('diary_id')->references('id')->on('diaries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary_segment_hash_tag');
        Schema::dropIfExists('diary_segments');
    }
};
