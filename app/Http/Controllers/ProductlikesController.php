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
     * @Request({
     *     summary: Get Product likes endpoint - GET request query parameters,
     *     description: Get product likes endpoint - Parameters for POST request requires either product_id or user_id { product_id || user_id },
     *     tags: Product
     * })
     * @Response(
     *    code: 200
     *    ref: Productlikes
     * )
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->product_id) {
            $likes = Productlikes::where("product_id", $request->product_id)->get();
        } elseif ($request->user_id) {
            $likes = Productlikes::where("user_id", $request->user_id)->get();
        }

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
     *     summary: Store Product like endpoint - GET request query parameters,
     *     description: Store product like endpoint - Parameters for POST request requires product_id, user_id and like: {product_id, user_id, like},
     *     tags: Product
     * })
     * @Response(
     *    code: 200
     *    ref: Productlikes
     * )
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
     * @Request({
     *     summary: Delete Product likes endpoint - GET request query parameters,
     *     description: Delete product likes endpoint - Parameters for POST request requires either product like id { id },
     *     tags: Product
     * })
     * @Response(
     *    code: 200
     *    ref: Productlikes
     * )
     * @param  \App\Models\Productlikes  $productlikes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $like = Productlikes::find($request->id);

        $like->delete();

        return Controller::responder(true, "Successfully removed entry.", []);
    }
}
