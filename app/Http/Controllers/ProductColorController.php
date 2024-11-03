<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductColorRequest;
use App\Http\Requests\UpdateProductColorRequest;
use App\Models\ProductColor;

class ProductColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     * @Request({
     *     summary: Get colors endpoint - POST request query parameters:,
     *     description: Get colors endpoint - Parameters for POST request must have the store id or user id {store_id || user_id},
     *     tags: ProductColor
     * })
     * @Response(
     *    code: 200
     *    ref: ProductColor
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreProductColorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductColorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductColor  $productColor
     * @return \Illuminate\Http\Response
     */
    public function show(ProductColor $productColor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductColor  $productColor
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductColor $productColor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductColorRequest  $request
     * @param  \App\Models\ProductColor  $productColor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductColorRequest $request, ProductColor $productColor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductColor  $productColor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductColor $productColor)
    {
        //
    }
}
