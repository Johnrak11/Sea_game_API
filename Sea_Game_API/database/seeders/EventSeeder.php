<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $events = [
            [
                'name' => "Men's U-22 Football",
                'description' => "The Football Federation of Cambodia on Tuesday, said that all free tickets for the public to watch the SEA Games, men’s football on April 29, has been distributed.",
                'available_ticket' => 8000,
                'date' => "2023-05-17",
                'category_id' => 2,
                'stadium_id' => 3,
            ],
            [
                'name' => "Woomen's U-22 Football",
                'description' => "The Football Federation of Cambodia on Tuesday, said that all free tickets for the public to watch the SEA Games, men’s football on April 29, has been distributed.",
                'available_ticket' => 80000,
                'date' => "2023-05-17",
                'category_id' => 3,
                'stadium_id' => 1,
            ],
            [
                'name' => "Men's U-22 Football",
                'description' => "The Football Federation of Cambodia on Tuesday, said that all free tickets for the public to watch the SEA Games, men’s football on April 29, has been distributed.",
                'available_ticket' => 30000,
                'date' => "2023-05-17",
                'category_id' => 4,
                'stadium_id' => 2,
            ],
        ];
        foreach ($events as $event) {
            Event::create($event);
        };
    }
}
