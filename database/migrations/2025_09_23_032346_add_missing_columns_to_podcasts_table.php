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
        Schema::table('podcasts', function (Blueprint $table) {
            $table->string('title')->after('id')->nullable();
            $table->text('description')->nullable()->after('title');
            $table->string('youtube_id')->unique()->nullable()->after('description');
            $table->string('thumbnail_url')->nullable()->after('youtube_id');
            $table->string('duration')->nullable()->after('thumbnail_url');
            $table->string('host')->nullable()->after('duration');
            $table->string('guest')->nullable()->after('host');
            $table->text('topics')->nullable()->after('guest');
            $table->date('published_date')->nullable()->after('topics');
            $table->integer('views')->default(0)->after('published_date');
            $table->boolean('is_featured')->default(false)->after('views');
            $table->boolean('is_active')->default(true)->after('is_featured');
            $table->integer('sort_order')->default(0)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('podcasts', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'description',
                'youtube_id',
                'thumbnail_url',
                'duration',
                'host',
                'guest',
                'topics',
                'published_date',
                'views',
                'is_featured',
                'is_active',
                'sort_order'
            ]);
        });
    }
};
