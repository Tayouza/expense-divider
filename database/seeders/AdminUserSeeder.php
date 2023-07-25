<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hasAdminUser = User::where('username', 'admin')->first();

        if (! $hasAdminUser) {
            User::create([
                'name' => 'Admin User',
                'username' => 'admin',
                'email' => 'admin@admin',
                'password' => Hash::make(env('ADMIN_PASS')),
            ]);
        }
    }
}
