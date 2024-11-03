<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRegisterRequest;
use App\Http\Requests\UpdateEventRegisterRequest;
use App\Models\EventRegister;
use Illuminate\Http\Request;

class EventRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Get event register endpoint - POST request query parameters:,
     *     description: Get event register endpoint - Parameters for POST request must have the user id {user_id},
     *     tags: Event
     * })
     * @Response(
     *    code: 200
     *    ref: EventRegister
     * )
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events = EventRegister::where("user_id", $request->user_id)->with("event")->orderBy("id", "DESC")->get();
        return Controller::responder(true, "Successfully retrieved your events.", $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @Request({
     *     summary: Create event register endpoint - POST request query parameters:,
     *     description: Create event register endpoint - Parameters for POST request must have the user id {user_id},
     *     tags: Event
     * })
     * @Response(
     *    code: 200
     *    ref: EventRegister
     * )
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\StoreEventRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRegisterRequest $request)
    {
    	$checker = EventRegister::where(["user_id" => $request->user_id, "event_id" => $request->event_id])->get();
    	
    	if (count($checker) > 0) {
	        return Controller::responder(false, "You have already registered for this event.", $checker);
    	} else {
    	
		$event = EventRegister::create([
			"event_id" => $request->id,
			"user_id" => $request->user_id
		]);
		
		return Controller::responder(true, "Successfully registered the user for the event.", $event);
	}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventRegister  $eventRegister
     * @return \Illuminate\Http\Response
     */
    public function show(EventRegister $eventRegister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventRegister  $eventRegister
     * @return \Illuminate\Http\Response
     */
    public function edit(EventRegister $eventRegister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRegisterRequest  $request
     * @param  \App\Models\EventRegister  $eventRegister
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRegisterRequest $request, EventRegister $eventRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventRegister  $eventRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventRegister $eventRegister)
    {
        //
    }
}
