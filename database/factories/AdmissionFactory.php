<?php

namespace Database\Factories;

use App\Enums\EnrollmentStatusEnum;
use App\Enums\SemesterEnum;
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
            'semester' => $this->faker->randomElement(SemesterEnum::values()),
            'school_year_id' => $randomSection->school_year_id,
            'course_id' => $randomSection->course_id,
            'section_id' => $randomSection->id,
            'is_new_student' => $this->faker->boolean(),
            'enrollment_status' => $this->faker->randomElement(EnrollmentStatusEnum::values()),
            'gpa' => $this->faker->randomElement([1.25, 1.5, 1.75, 2.0, 2.25, 2.5, 2.75, 3.0, 3.25, 3.5, 3.75, 4.0, 4.25, 4.5, 4.75, 5.0]),
        ];
    }
}
