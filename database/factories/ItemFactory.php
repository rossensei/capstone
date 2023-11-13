<?php

namespace Database\Factories;

use App\Models\Unit;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'category_id' => mt_rand(1, Category::count()),
            'unit_id' => mt_rand(1, Unit::count()),
            'qty' => fake()->randomNumber(3, false),
        ];
    }
}
