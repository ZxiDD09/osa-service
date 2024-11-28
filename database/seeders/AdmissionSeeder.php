<?php

namespace Database\Seeders;

use App\Models\Admission;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AdmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $randomStudents = Student::inRandomOrder()->limit(50)->get();

        $randomStudents->each(function ($student) {
            Admission::factory()->create([
                'candidate_id' => $student->candidate_id,
                'gpa' => fake()->randomFloat(2, 1, 4),
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
            ]);
        });
    }
}
