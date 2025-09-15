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
            $table->foreignId('user_id')->constrained();
            $table->foreignId('community_id')->nullable()->constrained();
            $table->string('title')->nullable();
            $table->text('content');
            $table->json('media')->nullable(); // multiple images/videos
            $table->enum('type', ['showcase', 'discussion', 'announcement', 'question', 'achievement']);
            $table->enum('status', ['published', 'draft', 'archived'])->default('published');
            $table->integer('likes_count')->default(0);
            $table->integer('comments_count')->default(0);
            $table->integer('views_count')->default(0);
            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->json('tags')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
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
