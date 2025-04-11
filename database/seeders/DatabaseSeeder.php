<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Site;
use App\Models\User;
use App\Models\Vehicle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);
        
        User::create([
            'name' => 'Org Admin',
            'email' => 'org@example.com',
            'password' => Hash::make('password'),
            'role' => 'organization',
        ]);
        
        User::create([
            'name' => 'Org User',
            'email' => 'orguser@example.com',
            'password' => Hash::make('password'),
            'role' => 'organization_user',
        ]);
    }
}
