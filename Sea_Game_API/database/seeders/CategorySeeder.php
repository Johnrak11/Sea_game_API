<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $sports = [
            ['name' => 'Athletics'],
            ['name' => 'aquatics'],
            ['name' => 'badminton'],
            ['name' => 'basketball'],
            ['name' => 'billiards'],
            ['name' => 'boxing'],
            ['name' => 'bodybuilding'],
            ['name' => 'chess'],
            ['name' => 'cycling'],
            ['name' => 'cricket'],
            ['name' => 'dance sport'],
            ['name' => 'E-sport'],
            ['name' => 'fencing'],
            ['name' => 'floorball'],
            ['name' => 'football'],
            ['name' => 'golf'],
            ['name' => 'gymnastics'],
            ['name' => 'hockey'],
            ['name' => 'jet ski'],
            ['name' => 'judo'],
            ['name' => 'karate'],
            ['name' => 'mixed martial arts'],
            ['name' => 'obstacle race'],
            ['name' => 'pencak silat'],
            ['name' => 'petanque'],
            ['name' => 'sailing'],
            ['name' => 'sepak takraw'],
            ['name' => 'soft tennis'],
            ['name' => 'tennis'],
            ['name' => 'table tennis'],
            ['name' => 'taekwondo'],
            ['name' => 'traditional boat race'],
            ['name' => 'triathlon'],
            ['name' => 'volleyball'],
            ['name' => 'weightlifting'],
            ['name' => 'wushu'],
            ['name' => 'wrestling'],
            ['name' => 'teqball']
        ];
        foreach ($sports as $sport) {
            Category::create($sport);
        };
    }
}
