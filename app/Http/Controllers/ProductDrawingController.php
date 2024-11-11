<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductDrawingRequest;
use App\Http\Requests\UpdateProductDrawingRequest;
use App\Models\ProductDrawing;

class ProductDrawingController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * @Request({
     *     summary: Store Product drawing endpoint - GET request query parameters,
     *     description: Store product drawing endpoint - Parameters for POST request requires product_id, title, description and url: {product_id, title, description, url},
     *     tags: Product
     * })
     * @Response(
     *    code: 200
     *    ref: ProductDrawing
     * )
     *
     * @param  \App\Http\Requests\StoreProductDrawingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductDrawingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductDrawing  $productDrawing
     * @return \Illuminate\Http\Response
     */
    public function show(ProductDrawing $productDrawing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductDrawing  $productDrawing
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductDrawing $productDrawing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductDrawingRequest  $request
     * @param  \App\Models\ProductDrawing  $productDrawing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductDrawingRequest $request, ProductDrawing $productDrawing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductDrawing  $productDrawing
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductDrawing $productDrawing)
    {
        //
    }
}
