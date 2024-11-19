<?php

namespace Database\Factories;

use App\Enums\CivilStatusEnum;
use App\Enums\SexEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Information>
 */
class InformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'suffix' => $this->faker->suffix,
            'zip_code' => $this->faker->postcode,
            'zone' => $this->faker->word,
            'barangay' => $this->faker->word,
            'municipality' => $this->faker->city,
            'province' => $this->faker->state,
            'date_of_birth' => $this->faker->date,
            'place_of_birth' => $this->faker->city,
            'sex' => $this->faker->randomElement(SexEnum::values()),
            'civil_status' => $this->faker->randomElement(CivilStatusEnum::values()),
            'religion' => $this->faker->word,
            'nationality' => $this->faker->country,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
