<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $viewerRole = Role::where('slug', 'user-viewer')->first();
        $superUserRole = Role::where('slug', 'super-user')->first();

        $testUsers = [
            [
                'name' => 'John Viewer',
                'email' => 'john.viewer@cheil.com',
                'password' => Hash::make('password'),
                'role_id' => $viewerRole->id,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@cheil.com',
                'password' => Hash::make('password'),
                'role_id' => $viewerRole->id,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Bob Admin',
                'email' => 'bob.admin@cheil.com',
                'password' => Hash::make('password'),
                'role_id' => $superUserRole->id,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Alice Viewer',
                'email' => 'alice.viewer@cheil.com',
                'password' => Hash::make('password'),
                'role_id' => $viewerRole->id,
                'email_verified_at' => now(),
            ],
        ];

        foreach ($testUsers as $userData) {
            User::create($userData);
        }
    }
}

