<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductlikesRequest;
use App\Http\Requests\UpdateProductlikesRequest;
use App\Models\Productlikes;
use Illuminate\Http\Request;

class ProductlikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $likes = Productlikes::where("product_id", $request->product_id)->get();
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
     * @param  \App\Http\Requests\StoreProductlikesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductlikesRequest $request)
    {
        $request->validate([
            "user_id" => ["required"],
            "product_id" => ["required"]
        ]);

        $like = Productlikes::where([
            "user_id" => $request->user_id,
            "product_id" => $request->product_id
        ])->get();

        if (count($like) > 0) {
            return Controller::responder(false, "You have already liked this product.", $like);
        }

        $like = Productlikes::create([
            "user_id" => $request->user_id,
            "product_id" => $request->product_id
        ]);

        return Controller::responder(true, "Successfully liked.", $like);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productlikes  $productlikes
     * @return \Illuminate\Http\Response
     */
    public function show(Productlikes $productlikes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productlikes  $productlikes
     * @return \Illuminate\Http\Response
     */
    public function edit(Productlikes $productlikes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductlikesRequest  $request
     * @param  \App\Models\Productlikes  $productlikes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductlikesRequest $request, Productlikes $productlikes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productlikes  $productlikes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productlikes $productlikes)
    {
        //
    }
}
