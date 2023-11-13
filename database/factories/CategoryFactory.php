<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cat_name' => fake()->randomElement(['Elementary Uniforms', 'Senior High School Uniforms', 'College Uniforms', 'School Supplies', 'Equipments', 'Furniture'])
        ];
    }
}
