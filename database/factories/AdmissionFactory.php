<?php

namespace Database\Factories;

use App\Enums\EnrollmentStatusEnum;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admission>
 */
class AdmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomSection = Section::inRandomOrder()->first();

        return [
            'semester' => $this->faker->randomElement(['1st', '2nd', '3rd', 'Summer']),
            'school_year_id' => $randomSection->school_year_id,
            'course_id' => $randomSection->course_id,
            'section_id' => $randomSection->id,
            'is_new_student' => $this->faker->boolean(),
            'enrollment_status' => $this->faker->randomElement(EnrollmentStatusEnum::values()),
        ];
    }
}
