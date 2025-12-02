<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Tests\TestCase;
use App\Models\User;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function ensureDashboardDependencies()
    {
        // Ensure course flags exist to avoid blade errors
        if (!Schema::hasColumn('course', 'is_active') || !Schema::hasColumn('course', 'is_featured')) {
            Schema::table('course', function (Blueprint $table) {
                if (!Schema::hasColumn('course', 'is_active')) {
                    $table->boolean('is_active')->default(false);
                }
                if (!Schema::hasColumn('course', 'is_featured')) {
                    $table->boolean('is_featured')->default(false);
                }
            });
        }

        // Ensure ecourse_enrollments table exists
        if (!Schema::hasTable('ecourse_enrollments')) {
            Schema::create('ecourse_enrollments', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->timestamps();
            });
        }
    }

    public function test_non_admin_gets_forbidden()
    {
        $this->ensureDashboardDependencies();

        $user = User::factory()->create([
            'email' => 'normal.user@example.com',
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    public function test_guest_is_redirected_to_login()
    {
        $this->ensureDashboardDependencies();

        $response = $this->get('/admin/dashboard');
        $response->assertRedirect(route('login'));
    }
}
