<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Tests\TestCase;
use App\Models\User;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_dashboard()
    {
        // Buat user admin dengan email yang dicek di AdminMiddleware
        $admin = User::factory()->create([
            'email' => 'multimedia.latihhobi@gmail.com',
        ]);

        // Pastikan kolom is_active dan is_featured ada di tabel course agar blade tidak error
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

        // Buat tabel ecourse_enrollments minimal jika belum ada
        if (!Schema::hasTable('ecourse_enrollments')) {
            Schema::create('ecourse_enrollments', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->timestamps();
            });
        }

        // Akses sebagai admin
        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Dashboard Admin');
    }
}
