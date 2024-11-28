<?php

namespace Database\Factories;

use App\Enums\CandidateStatusEnum;
use App\Enums\SeniorHighSchoolStrandEnum;
use App\Enums\SourceOfFamilyIncomeEnum;
use App\Enums\TypeOfSchoolGraduateFromEnum;
use App\Models\Information;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $information = Information::factory()->create();

        $annualIncomes = [
            '₱31,485 - ₱262,968',
            '₱262,969 - ₱524,936',
            '₱524,937 - ₱920,358',
            '₱920,359 - ₱1,577,808',
            '₱1,577,809 - ₱2,629,680',
            '₱2,629,681++',
        ];

        return [
            'information_id' => $information->id,
            'type_of_school_graduated_from' => $this->faker->randomElement(TypeOfSchoolGraduateFromEnum::values()),

            'senior_highschool_strand' => $this->faker->randomElement(SeniorHighSchoolStrandEnum::values()),

            'source_of_family_income' => $this->faker->randomElement(SourceOfFamilyIncomeEnum::values()),

            'is_first_generation_group' => $this->faker->boolean(),
            'is_indigenous_people_group' => $this->faker->boolean(),
            'is_person_with_disability_group' => $this->faker->boolean(),
            'is_solo_parent_group' => $this->faker->boolean(),
            'is_person_with_special_needs_group' => $this->faker->boolean(),
            'annual_income_amount' => $this->faker->randomElement($annualIncomes),

            'source_is_uni_fast' => $this->faker->boolean(),
            'source_is_other_scholarships' => $this->faker->boolean(),
            'source_is_self_financed' => $this->faker->boolean(),
            'source_is_parent' => $this->faker->boolean(),

            'has_mobile_phone' => $this->faker->boolean(),
            'has_laptop' => $this->faker->boolean(),
            'has_tablet' => $this->faker->boolean(),
            'has_desktop' => $this->faker->boolean(),
            'other_gadgets' => $this->faker->sentence(),

            'candidate_status' => $this->faker->randomElement(CandidateStatusEnum::values()),

            'is_passed' => $this->faker->boolean(),
            'created_at' => Carbon::now()->subDays(rand(0, 30)),

        ];
    }
}
