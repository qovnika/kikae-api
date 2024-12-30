<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoverageRequest;
use App\Http\Requests\UpdateCoverageRequest;
use App\Models\Coverage;
use Illuminate\Http\Request;

class CoverageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Get Coverage area endpoint - POST request query parameters,
     *     description: Get coverage area endpoint - Parameters for POST request must have the product id. { product_id },
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: Coverage
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            "product_id" => "required"
        ]);

        $cover = Coverage::where("product_id", $request->product_id)->orderBy("area", "DESC")->get();

        return Controller::responder(true, "Successfully retrieved Coverage areas.", $cover);
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
     *     summary: Add coverage area endpoint - POST request query parameters,
     *     description: Add coverage area endpoint - Parameters for POST request must have product id, area and fee. { product_id && area && fee },
     *     tags: Product
     * })
     * @Response(
     *    code: 200
     *    ref: Coverage
     * )
     *
     * @param  \App\Http\Requests\StoreCoverageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoverageRequest $request)
    {
        $request->validate([
            "product_id" => "required",
            "area" => "required",
            "fee" => "required"
        ]);

        $cover = Coverage::create([
            "product_id" => $request->product_id,
            "area" => $request->area,
            "fee" => $request->fee
        ]);

        return Controller::responder(true, "Successfully created coverage area.", $cover);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coverage  $coverage
     * @return \Illuminate\Http\Response
     */
    public function show(Coverage $coverage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coverage  $coverage
     * @return \Illuminate\Http\Response
     */
    public function edit(Coverage $coverage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @Request({
     *     summary: Update Coverage area endpoint - POST request query parameters,
     *     description: Update coverage area endpoint - Parameters for POST request must have coverage area id, area and fee. { id && area && fee },
     *     tags: Product
     * })
     * @Response(
     *    code: 200
     *    ref: Coverage
     * )
     *
     * @param  \App\Http\Requests\UpdateCoverageRequest  $request
     * @param  \App\Models\Coverage  $coverage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoverageRequest $request, Coverage $coverage)
    {
        $request->validate([
            "id" => "required",
            "area" => "required",
            "fee" => "required"
        ]);

        $cover = Coverage::find($request->id);
        $cover->area = $request->area;
        $cover->fee = $request->fee;

        return Controller::responder(true, "Successfully updated coverage area.", $cover);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Request({
     *     summary: Delete Coverage area endpoint - POST request query parameters,
     *     description: Delete coverage area endpoint - Parameters for POST request must have coverage area id. { id },
     *     tags: Product
     * })
     * @Response(
     *    code: 200
     *    ref: Coverage
     * )
     *
     * @param  \App\Models\Coverage  $coverage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $cover = Coverage::find($request->id);

        $cover->delete();

        return Controller::responder(true, "Successfully deleted coverage area.", []);
    }
}
