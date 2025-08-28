<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rule::create(
            [
                'tipe' => 'masuk',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'late_after' => '10:30:00',
                'role_group_id' => 1,
                'is_active' => true
            ],
        );

        Rule::create([
            'tipe' => 'pulang',
            'start_time' => '17:00:00',
            // 'end_time' => '12:00:00',
            // 'late_after' => '10:30:00',
            'role_group_id' => 1,
            'is_active' => true
        ]);
    }
}
