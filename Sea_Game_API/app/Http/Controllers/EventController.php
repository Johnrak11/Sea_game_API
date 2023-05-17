<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
        $events = Event::all();
        foreach ($events as $event) {
            $event->matchings;
        };
        return $events;
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
            'category_id' => 'required|integer|exists:categories,id',
            'stadium_id' => 'required|integer|exists:stadia,id',
        ];
        $matchingRules = [
            'team1' => 'required|string|max:50',
            'team2' => 'required|string|max:50',
            'time' => 'required|date_format:H:i:s'
        ];
        // =====validate===
        // event
        $event = $request['event'];
        $eventValidated = Validator::make($event, $EventRules);
        // matching
        if ($request['matching']) {
            foreach ($request['matching'] as $matching) {
                $matchingValidated = Validator::make($matching, $matchingRules);
                if ($matchingValidated->fails()) {
                    return response()->json([$matchingValidated->errors()], 400);
                }
            }
        }
        if ($eventValidated->fails()) {
            return response()->json([$eventValidated->errors()], 400);
        } else {
            $stadium = Stadium::find($event['stadium_id']);
            // create record available_ticket
            $available_ticket = intval($stadium['zoneA']) + intval($stadium['zoneB']);
            $event['available_ticket'] = $available_ticket;
            $eventCreate = Event::create($event);
            $matchings = [];

            // create matching
            if ($request['matching']) {
                foreach ($request['matching'] as $matching) {
                    $matching['event_id'] = $eventCreate->id;
                    $matchingCreate = Matching::create($matching);
                    $matchings[] = $matchingCreate;
                }
            }
            return response()->json(['success' => true, 'message' => 'Event created successful', 'data' => ['event' => $eventCreate, 'matching schedules' => $matchings]], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::find($id);
        if ($event === null) {
            return response()->json(['success' => false, 'data' => "Undefined event id: " . $id], 400);
        };
        $event->matchings;
        return response()->json(['success' => true, 'data' =>  $event], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $eventRules = [
            'name' => 'required|string|min:5',
            'description' => 'required|string|max:200',
            'date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:today',
                'before_or_equal:next year',
            ],
            'available_ticket' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
            'stadium_id' => 'required|integer|exists:stadia,id',
        ];
        $eventValidated = Validator::make($request->all(), $eventRules);
        if ($eventValidated->fails()) {
            return response()->json([$eventValidated->errors()], 400);
        } else {
            $eventUpdate = Event::find($id);
            if ($eventUpdate === null) {
                return response()->json(['success' => false, 'message' => 'Undefined event id: ' . $id], 400);
            } else {
                $eventUpdate->update($request->all());
                return response()->json(['success' => true, 'message' => 'Event updated successfully', 'data' => $eventUpdate], 200);
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete event
        $event = Event::find($id);
        if ($event === null) {
            return response()->json(['success' => false, 'message' => 'Undefined event id : ' . $id], 401);
        };
        $event->delete();
        return response()->json(['success' => true, 'message' => 'Event id : ' . $id . ' deleted successful'], 200);
    }

    /**
     * Search the specified resource from storage.
     */
    public function search(string $keyword)
    {
        $events = Event::where('name', 'like', '%' . $keyword . '%')->get();
        if ($events !== []) {
            return response()->json(['success' => false, 'message' => 'Result not found'], 401);
        };
        return response()->json(['success' => true, 'data' => $events], 200);
    }
}
