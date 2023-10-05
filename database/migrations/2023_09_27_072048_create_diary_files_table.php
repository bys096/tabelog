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
        Schema::create('diary_files', function (Blueprint $table) {
            $table->id();
            $table->string('origin_name');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('type');
            $table->bigInteger('size');
            $table->timestamps();

            $table->foreignId('diary_segment_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary_files');
    }
};
