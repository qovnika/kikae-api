<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id) {
            $events = Event::find($request->id);
        } elseif ($request->store_id) {
            $events = Event::orderBy("id","DESC")->where("store_id", $request->store_id)->get()->unique();
        } else {
            $events = Event::all()->sortByDesc("id")->unique();
        }
        return Controller::responder(true, "Success", $events);
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
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $request->validate([
            "name" => ["required"],
            "description" => ["required"],
            "dated" => ["required"],
            "timed" => ["required"]
        ]);

        $event = Event::create([
            "name" => $request->name,
            "description" => $request->description,
            "store_id" => $request->store_id,
            "dated" => $request->dated,
            "timed" => $request->timed,
            "event_type" => 1,
            "venue" => $request->venue
        ]);

        return Controller::responder(true, "Your event has been created successfully.", $event);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request)
    {
        $request->validate([
            "name" => ["required"],
            "description" => ["required"],
            "dated" => ["required"],
            "timed" => ["required"]
        ]);

        $event = Event::find($request->id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->dated = $request->dated;
        $event->timed = $request->timed;
        $event->venue = $request->venue;
        $event->save();

        return Controller::responder(true, "Updated successfully.", $event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $event = Event::find($request->id);
        $event->delete();

        return Controller::responder(true, $event->name." deleted successfully.", $event);
    }
}
