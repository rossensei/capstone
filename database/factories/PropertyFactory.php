<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Department;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_id' => mt_rand(1, Department::count()),
            'category_id' => mt_rand(1, Category::count()),
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'tag_no' => fake()->randomNumber(5, true),
            'date_acquired' => Carbon::now()->format('Y-m-d')
        ];
    }
}
