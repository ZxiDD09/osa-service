<?php

namespace Database\Seeders;

use App\Enums\CandidateStatusEnum;
use App\Models\Admission;
use App\Models\Candidate;
use App\Models\Information;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Information::factory()->count(100)->create([
            'father_last_name' => fake()->lastName,
            'father_first_name' => fake()->firstName,
            'father_middle_name' => fake()->firstName,
            'father_suffix' => fake()->suffix,
            'father_occupation' => fake()->jobTitle,

            'mother_last_name' => fake()->lastName,
            'mother_first_name' => fake()->firstName,
            'mother_middle_name' => fake()->firstName,
            'mother_suffix' => fake()->suffix,
            'mother_occupation' => fake()->jobTitle,

            'guardian_full_name' => fake()->name,
            'guardian_address' => fake()->address,
            'guardian_phone' => fake()->phoneNumber,
        ])
            ->each(function (Information $information) {
                $candidate = Candidate::factory()
                    ->create(['information_id' => $information->id]);

                if ($candidate->candidate_status === CandidateStatusEnum::STUDENT()) {
                    $user = User::factory()->create();

                    Student::factory()->create([
                        'user_id' => $user->id,
                        'candidate_id' => $candidate->id,
                        'password_string' => 'password',
                    ]);

                    $user->update(['name' => $information->full_name]);

                    Admission::factory()->create([
                        'candidate_id' => $candidate->id,
                    ]);
                }
            });

    }
}
