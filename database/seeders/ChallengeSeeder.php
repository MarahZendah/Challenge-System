<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $challenges = [
        ['title' => 'تحدي القراءة 30 يوم', 'description' => 'قراءة 10 صفحات يومياً', 'total_days' => 30],
        ['title' => 'تحدي الرياضة', 'description' => 'تمارين ضغط 20 مرة يومياً', 'total_days' => 30],
        ['title' => 'تعلم البرمجة', 'description' => 'حل مشكلة برمجية واحدة يومياً', 'total_days' => 30],
    ];

    foreach ($challenges as $challenge) {
        \App\Models\Challenge::create($challenge);
    }
    }
}
