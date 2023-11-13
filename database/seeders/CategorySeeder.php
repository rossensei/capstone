<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory()->create();

        $categories = [
            [
                'cat_name' => 'Elementary Uniforms',
            ],
            [
                'cat_name' => 'Senior High School Uniforms',
            ],
            [
                'cat_name' => 'College Uniforms',
            ],
            [
                'cat_name' => 'School Supplies',
            ],
            [
                'cat_name' => 'Equipment',
            ],
            [
                'cat_name' => 'Furniture',
            ],
        ];

        foreach($categories as $cat) {
            Category::create($cat);
        }
    }
}
