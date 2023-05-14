<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'zone' => 'required|string|',
            'event_id' => 'required|integer|',
        ];

        $validated = Validator::make($request->all(), $rules);
        $request['zone'] = strtoupper($request['zone']);
        if ($validated->fails()) {
            return response()->json([$validated->errors()], 400);
        } else {
            //format datetime
            $currentDateTime = Carbon::now('Asia/Phnom_Penh');
            $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
            // is ticket is full
            $stadium =  $this->getStadium(intval($request['event_id']));
            $bookingNumber = $this->getNumberOfZone($request['zone'], intval($request['event_id']));
            if ($request['zone'] === 'A' and $bookingNumber >= $stadium['zoneA']) {
                return response()->json(['success' => true, 'message' => 'Ticket on zone A has been full'], 201);
            } elseif (($request['zone'] === 'B' and $bookingNumber >= $stadium['zoneB'])) {
                return response()->json(['success' => true, 'message' => 'Ticket on zone B has been full'], 201);
            } else {
                $booking = new Booking;
                $booking->booking_date = $formattedDateTime;
                $booking->price = 'Free';
                $booking->zone = $request['zone'];
                $booking->event_id = $request['event_id'];
                $booking->save();
                return response()->json(['success' => true, 'message' => 'Booking ticket successful', 'data' => $booking], 201);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function getNumberOfZone(string $zone, string $event_id)
    {
        $numberOfZone = Booking::select('bookings.*')
            ->join('events', 'events.id', '=', 'bookings.event_id')
            ->where('bookings.zone', '=', $zone)
            ->where('bookings.event_id', '=', $event_id)
            ->count();
        return $numberOfZone;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
    public function getStadium(int $event_id)
    {
        $stadium = Stadium::select('stadia.*')
            ->join('events', 'events.stadium_id', '=', 'stadia.id')
            ->where('events.id', '=', $event_id)
            ->get()->first();
        return $stadium;
    }
}
