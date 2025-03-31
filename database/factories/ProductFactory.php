<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $coverImageId = $this->faker->numberBetween(1, 1000);
        $coverImage = "https://picsum.photos/id/{$coverImageId}/640/480";

        $gallery = collect(range(1, rand(3, 5)))->map(function () {
            $id = fake()->numberBetween(1, 1000);
            return "https://picsum.photos/id/{$id}/640/480";
        })->toArray();

        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph,
            'price' => fake()->randomFloat(2, 10, 999),
            'cover_image' => $coverImage,
            'images' => $gallery,
        ];
    }
}
