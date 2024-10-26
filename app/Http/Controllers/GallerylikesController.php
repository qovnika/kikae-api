<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGallerylikesRequest;
use App\Http\Requests\UpdateGallerylikesRequest;
use App\Models\Gallerylikes;

class GallerylikesController extends Controller
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
     * @param  \App\Http\Requests\StoreGallerylikesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGallerylikesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallerylikes  $gallerylikes
     * @return \Illuminate\Http\Response
     */
    public function show(Gallerylikes $gallerylikes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallerylikes  $gallerylikes
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallerylikes $gallerylikes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGallerylikesRequest  $request
     * @param  \App\Models\Gallerylikes  $gallerylikes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGallerylikesRequest $request, Gallerylikes $gallerylikes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallerylikes  $gallerylikes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallerylikes $gallerylikes)
    {
        //
    }
}
