<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRunwayProductRequest;
use App\Http\Requests\UpdateRunwayProductRequest;
use Illuminate\Http\Request;
use App\Models\RunwayProduct;

class RunwayProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Get Runway products endpoint - GET request query parameters,
     *     description: Get Runway products endpoint - Parameters for POST request must provide runway id { runway_id },
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: RunwayProduct
     * )
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $runway = RunwayProduct::where("runway_id", $request->runway_id)->get()->unique();

        return Controller::responder(true, "Successfully retrieved products for this runway video.", $runway);
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
     *     summary: Store Runway products endpoint - GET request query parameters,
     *     description: Store Runway products endpoint - Parameters for POST request must provide boomerang id and product id { runway_id && product_id },
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: RunwayProduct
     * )
     * 
     * @param  \App\Http\Requests\StoreRunwayProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRunwayProductRequest $request)
    {
        $request->validate([
            "runway_id" => "required|exists:storevideos,id",
            "product_id" => "required|exists:products,id"
        ]);

        $runway = RunwayProduct::create([
            "runway_id" => $request->runway_id,
            "product_id" => $request->product_id
        ]);

        return Controller::responder(true, "Product associated to Runway video successfully.", $runway);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RunwayProduct  $runwayProduct
     * @return \Illuminate\Http\Response
     */
    public function show(RunwayProduct $runwayProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RunwayProduct  $runwayProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(RunwayProduct $runwayProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @Request({
     *     summary: Store Runway products endpoint - GET request query parameters,
     *     description: Store Runway products endpoint - Parameters for POST request must provide boomerang id and product id { runway_id && product_id },
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: RunwayProduct
     * )
     * 
     * @param  \App\Http\Requests\UpdateRunwayProductRequest  $request
     * @param  \App\Models\RunwayProduct  $runwayProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRunwayProductRequest $request, RunwayProduct $runwayProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Request({
     *     summary: Delete Runway product endpoint - GET request query parameters,
     *     description: Delete Runway product endpoint - Parameters for POST request must provide the id of the association { id },
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: RunwayProduct
     * )
     * 
     * @param  \App\Models\UpdateRunwayProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $runway = RunwayProduct::find($request->id);

        $runway->delete();

        return Controller::responder(true, "Successfully deleted association.", []);
    }
}
