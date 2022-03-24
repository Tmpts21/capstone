<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //create admin user
        User::factory(User::class)->create([
            'name' => 'kent',
            'email' => 'kent@mail.com',
            'gender' => 'male',
            'city' => 'San rafael',
            'barangay' => 'Pulo',
            'present_address' => 'San rafael barangay pulo ',
            'permanent_address' => 'San rafael barangay pulo',
            'status' => 'normal',
            'role' => 'admin',
            'phone_number' => '09123456789',
            'latitude' => 14.9756,
            'longitude' => 121.0192,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
          ]);


          User::factory(User::class)->create([
            'name' => 'ian',
            'email' => 'ian@mail.com',
            'gender' => 'male',
            'city' => 'Dasmarinas',
            'barangay' => 'Salawag',
            'present_address' => 'Salawag Dasmarinas  ',
            'permanent_address' => 'Salawag Dasmarinas',
            'status' => 'normal',
            'role' => 'admin',
            'phone_number' => '09123456789',
            'latitude' => 14.3407,
            'longitude' => 120.9825,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
          ]);

        // create 100 users
        User::factory(100)->create();
        
       
    }
}
