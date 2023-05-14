<?php

namespace Database\Seeders;

use App\Models\Matching;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatchingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $matchings = [
            [
                'team1' => "Cambodia",
                'team2' => "Indonasia",
                'time' => "4:00",
                'event_id' => 1,
            ],
            [
                'team1' => "Cambodia",
                'team2' => "Thialand",
                'time' => "8:00",
                'event_id' => 1,
            ],
            [
                'team1' => "Cambodia",
                'team2' => "Indonasia",
                'time' => "20:00",
                'event_id' => 2,
            ],
            [
                'team1' => "Cambodia",
                'team2' => "Indonasia",
                'time' => "16:00",
                'event_id' => 2,
            ],
        ];
        foreach ($matchings as $matching) {

            Matching::create($matching);
        }
    }
}
