<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreratingsRequest;
use App\Http\Requests\UpdateStoreratingsRequest;
use App\Models\Storeratings;
use Illuminate\Http\Request;

class StoreratingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user_id && $request->store_id) {
            $rating = Storeratings::where([
                "store_id" => $request->store_id,
                "user_id" => $request->user_id
            ])->get();
        } else {
            $rating = Storeratings::where("store_id", $request->store_id)->get();
        }
        if (!$rating) {
            return Controller::responder(false, "There are no ratings for this store.", $rating);
        } else {
            return Controller::responder(true, "Successfully retrieved store ratings.", $rating);
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
     * @param  \App\Http\Requests\StoreStoreratingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreratingsRequest $request)
    {
        $request->validate([
            "user_id" => ["required"],
            "store_id" => ["required"],
            "rating" => ["required"]
        ]);

        $rating = Storeratings::where([
            "user_id" => $request->user_id,
            "store_id" => $request->store_id
        ])->get();

        if (count($rating) > 0) {
            $rate = Storeratings::where("store_id", $request->store_id)
            ->where("user_id", $request->user_id)
            ->update(["rating" => $request->rating]);

            $rate = Storeratings::where("store_id", $request->store_id)->get();

            return Controller::responder(true, "You have rated this store successfully.", $rate);
        }

        Storeratings::create([
            "user_id" => $request->user_id,
            "store_id" => $request->store_id,
            "rating" => $request->rating
        ]);

        $ratings = Storeratings::where("store_id", $request->store_id)->get();

        return Controller::responder(true, "Successfully rated.", $ratings);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Storeratings  $storeratings
     * @return \Illuminate\Http\Response
     */
    public function show(Storeratings $storeratings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Storeratings  $storeratings
     * @return \Illuminate\Http\Response
     */
    public function edit(Storeratings $storeratings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreratingsRequest  $request
     * @param  \App\Models\Storeratings  $storeratings
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreratingsRequest $request, Storeratings $storeratings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Storeratings  $storeratings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Storeratings $storeratings)
    {
        //
    }
}
