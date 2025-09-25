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
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'title')) {
                $table->string('title')->nullable();
            }
            if (!Schema::hasColumn('events', 'slug')) {
                $table->string('slug')->nullable()->unique();
            }
            if (!Schema::hasColumn('events', 'short_description')) {
                $table->string('short_description')->nullable();
            }
            if (!Schema::hasColumn('events', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('events', 'type')) {
                $table->string('type')->nullable();
            }
            if (!Schema::hasColumn('events', 'start_date')) {
                $table->dateTime('start_date')->nullable();
            }
            if (!Schema::hasColumn('events', 'end_date')) {
                $table->dateTime('end_date')->nullable();
            }
            if (!Schema::hasColumn('events', 'registration_start')) {
                $table->dateTime('registration_start')->nullable();
            }
            if (!Schema::hasColumn('events', 'registration_end')) {
                $table->dateTime('registration_end')->nullable();
            }
            if (!Schema::hasColumn('events', 'location')) {
                $table->string('location')->nullable();
            }
            if (!Schema::hasColumn('events', 'location_details')) {
                $table->text('location_details')->nullable();
            }
            if (!Schema::hasColumn('events', 'max_participants')) {
                $table->integer('max_participants')->nullable();
            }
            if (!Schema::hasColumn('events', 'current_participants')) {
                $table->integer('current_participants')->default(0);
            }
            if (!Schema::hasColumn('events', 'price')) {
                $table->decimal('price', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('events', 'image')) {
                $table->string('image')->nullable();
            }
            if (!Schema::hasColumn('events', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
            if (!Schema::hasColumn('events', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
            if (!Schema::hasColumn('events', 'status')) {
                $table->string('status')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $cols = [
                'title','slug','short_description','description','type','start_date','end_date',
                'registration_start','registration_end','location','location_details','max_participants',
                'current_participants','price','image','is_featured','is_active','status'
            ];
            foreach ($cols as $col) {
                if (Schema::hasColumn('events', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
