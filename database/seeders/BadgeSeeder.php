<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
        ['name' => 'بداية صاروخية', 'description' => 'أتممت أول يوم بنجاح', 'image' => 'fast_start.png'],
        ['name' => 'الملتزم الذهبي', 'description' => 'أتممت أسبوع كامل', 'image' => 'golden_commitment.png'],
        ['name' => 'بطل التحدي', 'description' => 'أنهيت التحدي كاملاً (30 يوم)', 'image' => 'hero.png'],
    ];

    foreach ($badges as $badge) {
        \App\Models\Badge::create($badge);
    }
    }
}
