<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductLocationRequest;
use App\Http\Requests\UpdateProductLocationRequest;
use App\Models\ProductLocation;

class ProductLocationController extends Controller
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
     * @param  \App\Http\Requests\StoreProductLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductLocationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductLocation  $productLocation
     * @return \Illuminate\Http\Response
     */
    public function show(ProductLocation $productLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductLocation  $productLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductLocation $productLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductLocationRequest  $request
     * @param  \App\Models\ProductLocation  $productLocation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductLocationRequest $request, ProductLocation $productLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductLocation  $productLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductLocation $productLocation)
    {
        //
    }
}
