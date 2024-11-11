<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductratingsRequest;
use App\Http\Requests\UpdateProductratingsRequest;
use App\Models\Productratings;
use Illuminate\Http\Request;

class ProductratingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user_id && $request->product_id) {
            $rating = Productratings::where([
                "product_id" => $request->product_id,
                "user_id" => $request->user_id
            ])->get();
        } else {
            $rating = Productratings::where("product_id", $request->product_id)->get();
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
     * @Request({
     *     summary: Store Product drawing endpoint - GET request query parameters,
     *     description: Store product drawing endpoint - Parameters for POST request requires product_id, title, description and url: {product_id, title, description, url},
     *     tags: Product
     * })
     * @Response(
     *    code: 200
     *    ref: Productratings
     * )
     *
     * @param  \App\Http\Requests\StoreProductratingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductratingsRequest $request)
    {
        $request->validate([
            "user_id" => ["required"],
            "product_id" => ["required"],
            "rating" => ["required"]
        ]);

        $rating = Productratings::where([
            "user_id" => $request->user_id,
            "product_id" => $request->product_id
        ])->get();

        if (count($rating) > 0) {
            $rate = Productratings::where("product_id", $request->product_id)
            ->where("user_id", $request->user_id)
            ->update(["rating" => $request->rating]);

            $rate = Productratings::where("product_id", $request->product_id)->get();

            return Controller::responder(true, "You have rated this product successfully.", $rate);
        }

        Productratings::create([
            "user_id" => $request->user_id,
            "product_id" => $request->product_id,
            "rating" => $request->rating
        ]);

        $ratings = Productratings::where("product_id", $request->product_id)->get();

        return Controller::responder(true, "Successfully rated product.", $ratings);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productratings  $productratings
     * @return \Illuminate\Http\Response
     */
    public function show(Productratings $productratings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productratings  $productratings
     * @return \Illuminate\Http\Response
     */
    public function edit(Productratings $productratings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductratingsRequest  $request
     * @param  \App\Models\Productratings  $productratings
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductratingsRequest $request, Productratings $productratings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productratings  $productratings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productratings $productratings)
    {
        //
    }
}
