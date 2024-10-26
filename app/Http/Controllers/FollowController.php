<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowRequest;
use App\Http\Requests\UpdateFollowRequest;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->store_id) {
            $follows = Follow::orderBy("id", "DESC")->where("store_id", $request->store_id)->get()->unique();
        } else if ($request->user_id) {
            $follows = Follow::with("store")->where("user_id", $request->user_id)->paginate(20);
        } else {
            $follows = Follow::all()->sortByDesc("id");
        }
        
        return Controller::responder(true, "Successfully retrieved followings.", $follows);
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
     * @param  \App\Http\Requests\StoreFollowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFollowRequest $request)
    {
        $request->validate([
            "store_id" => "required",
            "user_id" => "required"
        ]);

        $follow = Follow::where(["store_id" => $request->store_id, "user_id" => $request->user_id])->get();
        if (count($follow) > 0) {
            return Controller::responder(false, "You are currently following this store.", $follow);
        }

        $follow = Follow::create([
            "store_id" => $request->store_id,
            "user_id" => $request->user_id
        ]);

        $follows = Follow::orderBy("id", "DESC")->where("store_id", $request->store_id)->get()->unique();

        return Controller::responder(true, "You are now following this store.", $follows);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFollowRequest  $request
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFollowRequest $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $follow = Follow::firstWhere(["store_id" => $request->store_id, "user_id" => $request->user_id]);
        $follow->delete();

        $follows = Follow::orderBy("id", "DESC")->where("store_id", $request->store_id)->get()->unique();

        return Controller::responder(true, "Successfully unfollowed store.", $follows);
    }
}
