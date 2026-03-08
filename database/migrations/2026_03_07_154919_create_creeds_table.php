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
        Schema::create('creeds', function (Blueprint $table) {
            $table->id();
            $table->string('title_jp')->comment('Japanese character like 和, 新, 正');
            $table->string('title_en')->comment('English label like Harmony, Innovation, Fairness');
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creeds');
    }
};
