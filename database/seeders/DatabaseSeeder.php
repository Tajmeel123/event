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
        // \App\Models\User::factory(10)->create();
        // \App\Models\Student::factory(100000)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Role::create([
            'name' => 'admin',
            'description' => 'admin role',
        ]);
        \App\Models\Role::create([
            'name' => 'user',
            'description' => 'user role',
        ]);

        \App\Models\Permission::create([
            'name' => 'add_user',
            'description' => 'you can add new user',
        ]);
        \App\Models\Permission::create([
            'name' => 'view_user',
            'description' => 'user can view the user information',
        ]);
    }
}
