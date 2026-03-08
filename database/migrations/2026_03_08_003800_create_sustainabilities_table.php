<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sustainabilities', function (Blueprint $table) {
            $table->id();
            $table->string('category', 50)->index(); // forest, community, environment, etc.
            $table->string('title', 200);
             $table->string('slug')->unique();
            $table->text('description');
            $table->string('cover_image')->nullable();
            $table->string('icon', 50)->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('sustainability_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sustainability_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sustainability_images');
        Schema::dropIfExists('sustainabilities');
    }
};
