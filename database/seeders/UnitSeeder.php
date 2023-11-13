<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            [
                'name' => 'pieces',
                'abbreviation' => 'pcs',
                'description' => fake()->sentence()
            ],
            [
                'name' => 'reams',
                'abbreviation' => 'r',
                'description' => fake()->sentence()
            ],
            [
                'name' => 'boxes',
                'abbreviation' => 'bxs',
                'description' => fake()->sentence()
            ],
        ];

        foreach($units as $unit) {
            Unit::create($unit);
        }
    }
}
