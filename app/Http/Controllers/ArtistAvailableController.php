<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtistAvailableRequest;
use App\Http\Requests\UpdateArtistAvailableRequest;
use App\Models\ArtistAvailable;
use Illuminate\Http\Request;

class ArtistAvailableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Get artist dates and times already booked endpoint - POST request query parameters,
     *     description: Get artist dates and times already booked endpoint - Parameters for POST request must provide the Store ID { store_id },
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: ArtistAvailable
     * )
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->store_id) {
            $avail = ArtistAvailable::where("store_id", $request->store_id)->orderBy("dated", "DESC")->get();

            return Controller::responder(true, "Successfully retrieved times.", $avail);
        }
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
     *     summary: Create artist dates and times already booked endpoint - POST request query parameters,
     *     description: Create artist dates and times already booked endpoint - Parameters for POST request must provide the Store ID, product ID and date + time { store_id && product_id && dated },
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: ArtistAvailable
     * )
     * 
     * @param  \App\Http\Requests\StoreArtistAvailableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArtistAvailableRequest $request)
    {
        $request->validate([
            "store_id" => "required",
            "product_id" => "required",
            "dated" => "required"
        ]);

        $avail = ArtistAvailable::create([
            "store_id" => $request->store_id,
            "dated" => $request->dated
        ]);

        return Controller::responder(true, "Successfully added scheduled time.", $avail);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArtistAvailable  $artistAvailable
     * @return \Illuminate\Http\Response
     */
    public function show(ArtistAvailable $artistAvailable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArtistAvailable  $artistAvailable
     * @return \Illuminate\Http\Response
     */
    public function edit(ArtistAvailable $artistAvailable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @Request({
     *     summary: Update artist dates and times already booked endpoint - POST request query parameters,
     *     description: Update artist dates and times already booked endpoint - Parameters for POST request must provide the Availability ID and date + time { id && dated },
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: ArtistAvailable
     * )
     * 
     * @param  \App\Http\Requests\UpdateArtistAvailableRequest  $request
     * @param  \App\Models\ArtistAvailable  $artistAvailable
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArtistAvailableRequest $request, ArtistAvailable $artistAvailable)
    {
        $request->validate([
            "id" => "required",
            "dated" => "required"
        ]);

        $avail = ArtistAvailable::find($request->id);
        $avail->dated = $request->dated;

        return Controller::responder(true, "Successfully added scheduled time.", $avail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Request({
     *     summary: Delete artist dates and times already booked endpoint - POST request query parameters,
     *     description: Delete artist dates and times already booked endpoint - Parameters for POST request must have the Availablilty ID { id },
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: ArtistAvailable
     * )
     *
     * @param  \App\Models\ArtistAvailable  $artistAvailable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $art = ArtistAvailable::find($request->id);
        $art->delete();

        return Controller::responder(true, "Successfully deleted availability.", []);
    }
}
