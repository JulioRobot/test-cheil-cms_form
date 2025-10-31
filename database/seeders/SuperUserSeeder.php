<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the Super User role ID
        $superUserRole = DB::table('roles')->where('slug', 'super-user')->first();

        // Create default super user
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@cheil.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_id' => $superUserRole->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
