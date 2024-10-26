<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGallerycommentsRequest;
use App\Http\Requests\UpdateGallerycommentsRequest;
use App\Models\Gallerycomments;

class GallerycommentsController extends Controller
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
     * @param  \App\Http\Requests\StoreGallerycommentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGallerycommentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallerycomments  $gallerycomments
     * @return \Illuminate\Http\Response
     */
    public function show(Gallerycomments $gallerycomments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallerycomments  $gallerycomments
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallerycomments $gallerycomments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGallerycommentsRequest  $request
     * @param  \App\Models\Gallerycomments  $gallerycomments
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGallerycommentsRequest $request, Gallerycomments $gallerycomments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallerycomments  $gallerycomments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallerycomments $gallerycomments)
    {
        //
    }
}
