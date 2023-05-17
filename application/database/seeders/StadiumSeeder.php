<?php

namespace Database\Seeders;

use App\Models\Stadium;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StadiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $stadiums = [
            [
                'name' => 'Morodok Techo National Stadium',
                'zoneA' => 5000,
                'zoneB' => 70000,
                'address' => 'National Road No.5 Kandal, 20km from Phnom Penh International Airport crossing the Prek Pnov Bridge, 4km Tonle Sap River and 5 km from the Mekong'
            ],
            [
                'name' => 'Phnom Penh Olympic Stadium',
                'zoneA' => 5000,
                'zoneB' => 25000,
                'address' => 'Charles de Gaulle Boulevard (Street 217), Khan Prampir Makara, Sangkat Veal Vong, 120307 Phnom Penh, Cambodia'
            ],
            [
                'name' => 'Cambodian League',
                'zoneA' => 1000,
                'zoneB' => 7000,
                'address' => '#0663, st.307, Phum khmounh, Sangkat khmounh, khan Sen Sok, 12103 Phnom Penh, Cambodia'
            ],
        ];
        foreach ($stadiums as $stadium) {
            Stadium::create($stadium);
        }
    }
}
