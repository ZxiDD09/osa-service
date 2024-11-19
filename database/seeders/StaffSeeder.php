<?php

namespace Database\Seeders;

use App\Models\Information;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create()->each(function ($user) {
            $information = Information::factory()->create();

            Staff::factory()->create([
                'information_id' => $information->id,
                'user_id' => $user->id,
            ]);
        });
    }
}
