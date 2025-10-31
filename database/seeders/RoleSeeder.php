<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super User',
                'slug' => 'super-user',
                'description' => 'Has full access to all features including user and role management',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Viewer',
                'slug' => 'user-viewer',
                'description' => 'Has limited access with read-only permissions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
