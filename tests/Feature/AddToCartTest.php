<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Ecourse;

class AddToCartTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_to_cart_creates_cart_and_item()
    {
        // Buat user
        $user = User::factory()->create();

        // Buat kategori dulu karena ada foreign key
        $category = \App\Models\Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
        ]);

        // Buat course (ecourse)
        $course = Ecourse::create([
            'id_category' => $category->id_category,
            'name' => 'Test Course',
            'course_by' => 'Test Instructor',
            'price' => 100000,
            'image_url' => 'test.jpg',
        ]);

        // Pastikan belum ada cart untuk user
        $this->assertDatabaseMissing('cart', [
            'id_user' => $user->id,
        ]);

        // Lakukan request POST sebagai user yang sudah login
        $response = $this->actingAs($user)->post(route('ecourse.addToCart', $course->id_course));

        // Redirect back expected
        $response->assertStatus(302);

        // Cek cart dibuat
        $this->assertDatabaseHas('cart', [
            'id_user' => $user->id,
        ]);

        // Ambil cart id
        $cart = \App\Models\Cart::where('id_user', $user->id)->first();
        $this->assertNotNull($cart);

        // Cek cart_items dibuat
        $this->assertDatabaseHas('cart_items', [
            'id_cart' => $cart->id_cart,
            'id_course' => $course->id_course,
            'quantity' => 1,
            'price' => 100000,
            'sub_total' => 100000,
        ]);
    }
}
