<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Web Development',
            'Data Science',
            'Mobile Development',
            'Design',
            'Marketing',
            'Business',
            'Photography',
            'Writing',
            'Personal Development',
            'Finance'
        ];

        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(3),
            'category' => fake()->randomElement($categories),
            'price' => fake()->numberBetween(199000, 999000),
            'rating' => fake()->randomFloat(1, 3.5, 5.0),
            'total_reviews' => fake()->numberBetween(10, 1000),
            'image' => '/placeholder.svg?height=300&width=400&query=' . urlencode(fake()->words(2, true)),
            'is_active' => fake()->boolean(90), // 90% chance of being active
        ];
    }

    /**
     * Indicate that the course is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that the course is highly rated.
     */
    public function highlyRated(): static
    {
        return $this->state(fn (array $attributes) => [
            'rating' => fake()->randomFloat(1, 4.5, 5.0),
            'total_reviews' => fake()->numberBetween(500, 2000),
        ]);
    }
}
