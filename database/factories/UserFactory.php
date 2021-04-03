<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'organization_name' => $this->faker->company,
            'street' => $this->faker->streetName,
            'city' => $this->faker->city,
            'email' => $this->faker->unique()->safeEmail,
            'mobile_number' => $this->faker->unique()->phoneNumber,
            'password' => '$2y$10$E/QVTKAkXB1nI.xkle2CsOdSOGzk4ua1k69WE.AUdgHyPtQ5IoXY6', // password
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
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
