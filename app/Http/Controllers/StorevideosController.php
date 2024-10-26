<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorestorevideosRequest;
use App\Http\Requests\UpdatestorevideosRequest;
use App\Models\storevideos;
use Illuminate\Http\Request;

class StorevideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->store_id) {
            $videos = Storevideos::where("store_id", $request->store_id)->get();
        } elseif ($request->id) {
            $videos = Storevideos::where("id", $request->id)->get();
        } else {
            $videos = StoreVideos::orderBy("id", "DESC")->paginate(8);
        }
        if ($videos) {
            return Controller::responder(true, "Successfully retrieved Boomerang videos.", $videos);
        } else {
            return Controller::responder(false, "Unable to retrieve Boomerang videos.", $videos);
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
     * @param  \App\Http\Requests\StorestorevideosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorestorevideosRequest $request)
    {
        $request->validate([
            "store_id" => ["required"],
            "url" => ["required"]
        ]);

        $video = Storevideos::create([
            "store_id" => $request->store_id,
            "url" => $request->url
        ]);

        return Controller::responder(true, "The video has been successfully added to your store's boomerang videos.", $video);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\storevideos  $storevideos
     * @return \Illuminate\Http\Response
     */
    public function show(storevideos $storevideos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\storevideos  $storevideos
     * @return \Illuminate\Http\Response
     */
    public function edit(storevideos $storevideos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatestorevideosRequest  $request
     * @param  \App\Models\storevideos  $storevideos
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatestorevideosRequest $request, storevideos $storevideos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\UpdatestorevideosRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $video = storevideos::find($request->id);
        $video->delete();

        return Controller::responder(true, "Success.", $video);
    }
}
