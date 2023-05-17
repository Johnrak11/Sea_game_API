<?php

namespace App\Http\Controllers;

use App\Models\Matching;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatchingController extends Controller
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
        $matchingRules = [
            'team1' => 'required|string|max:50',
            'team2' => 'required|string|max:50',
            'time' => 'required|date_format:H:i:s',
            'event_id' => 'required|integer|exists:events,id'
        ];
        $matchingValidated = Validator::make($request->all(), $matchingRules);
        if ($matchingValidated->fails()) {
            return response()->json([$matchingValidated->errors()], 400);
        } else {
            $matchingCreated = Matching::create($request->all());
            return response()->json(['success' => true, 'message' => 'Matching updated successfully', 'data' => $matchingCreated], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stadium = Event::find($id);
        if ($stadium === null) {
            return response()->json(['success' => true, 'data' => "Undefined event id: " . $id], 400);
        };
        $matchings = $stadium->matchings;
        return response()->json(['success' => true, 'data' => $matchings], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matching $matching)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $matchingRules = [
            'team1' => 'required|string|max:50',
            'team2' => 'required|string|max:50',
            'time' => 'required|date_format:H:i:s',
            'event_id' => 'required|integer|exists:events,id'
        ];
        $matchingValidated = Validator::make($request->all(), $matchingRules);
        if ($matchingValidated->fails()) {
            return response()->json([$matchingValidated->errors()], 400);
        } else {
            $matchingUpdate = Matching::find($id);
            if ($matchingUpdate === null) {
                return response()->json(['success' => false, 'message' => 'Undefined matching id: ' . $id], 400);
            } else {
                $matchingUpdate->update($request->all());
                return response()->json(['success' => true, 'message' => 'Matching updated successfully', 'data' => $matchingUpdate], 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete event
        $matching = Event::find($id);
        if ($matching === null) {
            return response()->json(['success' => false, 'message' => 'Undefined matching id : ' . $id], 400);
        };
        $matching->delete();
        return response()->json(['success' => true, 'message' => 'Matching id : ' . $id . ' deleted successful'], 200);
    }
}
