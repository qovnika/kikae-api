<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoryRequest;
use App\Http\Requests\UpdateStoryRequest;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->store_id) {
            $videos = Story::where("store_id", $request->store_id)->get();
        } elseif ($request->id) {
            $videos = Story::where("id", $request->id)->get();
        } else {
            $videos = Story::all()->sortByDesc("id")->unique();
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
     * @param  \App\Http\Requests\StoreStoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoryRequest $request)
    {
        $request->validate([
            "store_id" => ["required"],
            "url" => ["required"]
        ]);

        $video = Story::create([
            "store_id" => $request->store_id,
            "url" => $request->url
        ]);

        return Controller::responder(true, "The video has been successfully added to your store's stories.", $video);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoryRequest  $request
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoryRequest $request, Story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $video = story::find($request->id);
        $video->delete();

        return Controller::responder(true, "Success.", $video);
    }
}
