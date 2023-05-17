<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use App\Http\Requests\StoreStadiumRequest;
use App\Http\Requests\UpdateStadiumRequest;

class StadiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stadiums = Stadium::all();
        return response()->json(['success' => true, 'data' => $stadiums], 200);
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
    public function store(StoreStadiumRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Stadium::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stadium $stadium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStadiumRequest $request, Stadium $stadium)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stadium $stadium)
    {
        //
    }
}
