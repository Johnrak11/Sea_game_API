<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $bookings = [
            [
                'booking_date' => '2023-05-15',
                'price' => 'Free',
                'zone' => 'B',
                'event_id' => 1,
            ],
            [
                'booking_date' => '2023-05-15',
                'price' => 'Free',
                'zone' => 'B',
                'event_id' => 1,
            ],
            [
                'booking_date' => '2023-05-15',
                'price' => 'Free',
                'zone' => 'B',
                'event_id' => 1,
            ],
        ];
        foreach ($bookings as $booking) {
            Booking::create($booking);
        };
    }
}
