<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()

    {

        $barangays = ['Pantubig',
        'Pasong Bangkal',
        'Pasong Callos', 
        'Pason intsik',
        'Pinacpinacan',
        'Poblacion',
        'Pulo',
        'Pulong Bayabas',
        'Salapungan',
        'Sampaloc',
        'San Agustin',
        'San Roque',
        'Talacsan',
        'Tambubong',
        'Tukod',
        'Ulingao',
        'Sapang Pahalang'];

      $coordinates = [
            [15.026340,121.118430],
            [15.0024 ,121.0134],
            [14.9955, 120.9905],
            [15.0093 ,120.9676],
            [14.9911 , 120.9159 ],
            [14.9567 , 120.9633],
            [14.9756 , 121.0192 ],
            [15.0179 , 120.9102 ],
            [15.0216 , 120.9633 ],
            [14.9809 ,120.9231],
            [15.0294,120.9288],
            [15.0093,120.9331],
            [14.9652,120.9848],
            [14.9701,120.9260],
            [14.9964,121.0536],
            [14.9796,120.9145],
            [14.9938,121.0364],
      ];


        $b = rand(1 , count($barangays)) - 1 ;
        $gender = $this->faker->randomElements(['male', 'female'])[0];


        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'gender' => $gender,
            'city' => $this->faker->city,
            'barangay' => $barangays[$b],
            'present_address' => $this->faker->address,
            'permanent_address' =>$this->faker->address,
            'phone_number' =>$this->faker->phoneNumber,
            'latitude' => $coordinates[$b][0],
            'longitude' => $coordinates[$b][1],
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
