<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Matching;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
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
        $EventRules = [
            'name' => 'required|string|min:5',
            'description' => 'required|string|max:200',
            'date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:today',
                'before_or_equal:next year',
            ],
            'category_id' => 'required|integer|',
            'stadium_id' => 'required|integer|',
        ];
        $matchingRules = [
            'team1' => 'required|string|max:50',
            'team2' => 'required|string|max:50',
            'time' => 'required|date_format:H:i'
        ];
        // =====validate===
        // event
        $event = $request['event'];
        $eventValidated = Validator::make($event, $EventRules);
        // matching
        foreach ($request['matching'] as $matching) {
            $matchingValidated = Validator::make($matching, $matchingRules);
            if ($matchingValidated->fails()) {
                return response()->json([$matchingValidated->errors()], 400);
            }
        }
        if ($eventValidated->fails()) {
            return response()->json([$eventValidated->errors()], 400);
        } else {
            $stadium = Stadium::find($event['stadium_id']);
            if ($stadium === null) {
                return response()->json(['success' => false, 'message' => 'Undefined stadium'], 400);
            } else {
                // create record available_ticket
                $available_ticket = intval($stadium['zoneA']) + intval($stadium['zoneB']);
                $event['available_ticket'] = $available_ticket;
                $eventCreate = Event::create($event);
                $matchings = [];

                // create matching
                foreach ($request['matching'] as $matching) {
                    $matching['event_id'] = $eventCreate->id;
                    $matchingCreate = Matching::create($matching);
                    $matchings[] = $matchingCreate;
                }
                return response()->json(['success' => true, 'message' => 'Event created successful', 'data' => ['event' => $eventCreate, 'matching schedules' => $matchings]], 200);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::find($id);
        return response()->json(['success' => true, 'data' => $event], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete event
        $event = Event::find($id);
        $event->delete();
        return response()->json(['success' => true, 'message' => 'Event id : ' . $id . ' deleted successful'], 200);
    }

    public function search(string $keyword)
    {
        $events = Event::where('name', 'like', '%' . $keyword . '%')->get();
        return response()->json(['success' => true, 'data' => $events], 200);
    }
}
