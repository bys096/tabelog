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
        Schema::create('diary_segment_hash_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diary_segment_id')->constrained();
            $table->foreignId('hash_tag_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary_segment_hash_tag');
    }
};
