<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStorelikesRequest;
use App\Http\Requests\UpdateStorelikesRequest;
use App\Models\Storelikes;
use Illuminate\Http\Request;

class StorelikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $likes = Storelikes::where("store_id", $request->store_id)->get();
        return Controller::responder(true, "Successfully retrieved likes.", $likes);
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
     *     summary: Get Product endpoint - GET request query parameters,
     *     description: Get product endpoint - Parameters for POST request: {store_id, user_id, like},
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: Storelikes
     * )
     * @param  \App\Http\Requests\StoreStorelikesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStorelikesRequest $request)
    {
        $request->validate([
            "user_id" => ["required"],
            "store_id" => ["required"]
        ]);

        $like = Storelikes::where([
            "user_id" => $request->user_id,
            "store_id" => $request->store_id
        ])->get();

        if (count($like) > 0) {
            return Controller::responder(false, "You have already liked this store.", $like);
        }

        Storelikes::create([
            "user_id" => $request->user_id,
            "store_id" => $request->store_id
        ]);

        $likes = Storelikes::where("store_id", $request->store_id)->get();

        return Controller::responder(true, "Successfully liked.", $likes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Storelikes  $storelikes
     * @return \Illuminate\Http\Response
     */
    public function show(Storelikes $storelikes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Storelikes  $storelikes
     * @return \Illuminate\Http\Response
     */
    public function edit(Storelikes $storelikes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStorelikesRequest  $request
     * @param  \App\Models\Storelikes  $storelikes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStorelikesRequest $request, Storelikes $storelikes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Storelikes  $storelikes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Storelikes $storelikes)
    {
        //
    }
}
