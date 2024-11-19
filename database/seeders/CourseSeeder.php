<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Section;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $yearLevels = ['1', '2', '3', '4', '5'];

        $sections = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];

        Course::factory()->count(100)->create()
            ->each(function ($course) use ($yearLevels, $sections) {
                collect($yearLevels)->each(function ($yearLevel) use ($course, $sections) {
                    collect($sections)->each(function ($section) use ($course, $yearLevel) {
                        Section::factory()->count(1)->create([
                            'course_id' => $course->id,
                            'department_id' => $course->department_id,
                            'school_year_id' => $course->school_year_id,
                            'name' => $yearLevel.$section,
                        ]);
                    });
                });
            });
    }
}
