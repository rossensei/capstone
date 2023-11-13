<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            DepartmentSeeder::class,
            UnitSeeder::class,
            CategorySeeder::class,
            PropertySeeder::class,
            ItemSeeder::class,
            TransactionSeeder::class,
            TransactionItemSeeder::class,
            RolesAndPermissionSeeder::class,
        ]);
    }
}
