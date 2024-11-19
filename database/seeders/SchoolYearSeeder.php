<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use Illuminate\Database\Seeder;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            '2020-2021',
            '2021-2022',
            '2022-2023',
            '2023-2024',
            '2024-2025',
            '2025-2026',
            '2026-2027',
            '2027-2028',
            '2028-2029',
            '2029-2030',
        ])->each(function (string $schoolYear) {
            SchoolYear::factory()->create([
                'name' => $schoolYear,
            ]);
        });
    }
}
