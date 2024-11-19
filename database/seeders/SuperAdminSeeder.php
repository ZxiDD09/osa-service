<?php

namespace Database\Seeders;

use App\Enums\CivilStatusEnum;
use App\Enums\SexEnum;
use App\Models\Information;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Office of Student Affairs',
            'email' => 'osa@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $information = Information::factory()->create([
            'first_name' => 'Office',
            'middle_name' => 'of',
            'last_name' => 'Student Affairs',
            'zip_code' => '1234',
            'zone' => 'Zone 1',
            'barangay' => 'Barangay 1',
            'municipality' => 'Municipality 1',
            'province' => 'Province 1',
            'date_of_birth' => '2021-01-01',
            'place_of_birth' => 'Place 1',
            'sex' => SexEnum::MALE(),
            'civil_status' => CivilStatusEnum::SINGLE(),
            'religion' => 'Religion 1',
            'nationality' => 'Nationality 1',
            'phone' => '09123456789',
        ]);

        Staff::factory()->create([
            'title' => 'Super Admin',
            'position' => 'OSA Director',
            'information_id' => $information->id,
            'user_id' => $user->id,
        ]);

    }
}
