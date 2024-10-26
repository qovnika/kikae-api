<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventMediaRequest;
use App\Http\Requests\UpdateEventMediaRequest;
use App\Models\EventMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events = EventMedia::where("event_id", $request->event_id)->get()->unique();

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
     * @param  \App\Http\Requests\StoreEventMediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventMediaRequest $request)
    {
        $request->validate([
            "event_id" => ["required"],
            "url" => ["required"]
        ]);

        $media = EventMedia::create([
            "event_id" => $request->event_id,
            "url" => $request->url
        ]);

        return Controller::responder(true, "Successfully uploaded and stored.", $media);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventMedia  $eventMedia
     * @return \Illuminate\Http\Response
     */
    public function show(EventMedia $eventMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventMedia  $eventMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(EventMedia $eventMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventMediaRequest  $request
     * @param  \App\Models\EventMedia  $eventMedia
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventMediaRequest $request, EventMedia $eventMedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventMedia  $eventMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $medium = EventMedia::find($request->id);
        $media = $medium;
 	Storage::delete($medium->url);
 	$medium->delete();
 	
 	return Controller::responder(true, "The medium has been deleted successfully.", $media);       
    }
}
