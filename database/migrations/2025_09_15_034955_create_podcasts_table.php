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
        if (Schema::hasTable('podcasts')) {
            return;
        }

        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('transcript')->nullable();
            $table->string('audio_url');
            $table->string('video_url')->nullable();
            $table->string('cover_image')->nullable();
            $table->integer('duration'); // dalam detik
            $table->integer('episode_number')->nullable();
            $table->string('season')->nullable();
            $table->integer('play_count')->default(0);
            $table->integer('download_count')->default(0);
            $table->date('published_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamp('published_date')->useCurrent();
            $table->json('guests')->nullable(); // info tamu podcast
            $table->json('topics')->nullable(); // topik yang dibahas
            $table->json('timestamps')->nullable(); // timestamp untuk setiap topik
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcasts');
    }
};
