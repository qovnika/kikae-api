<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventLikeRequest;
use App\Http\Requests\UpdateEventLikeRequest;
use App\Models\EventLike;

class EventLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreEventLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventLike  $eventLike
     * @return \Illuminate\Http\Response
     */
    public function show(EventLike $eventLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventLike  $eventLike
     * @return \Illuminate\Http\Response
     */
    public function edit(EventLike $eventLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventLikeRequest  $request
     * @param  \App\Models\EventLike  $eventLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventLikeRequest $request, EventLike $eventLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventLike  $eventLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventLike $eventLike)
    {
        //
    }
}
