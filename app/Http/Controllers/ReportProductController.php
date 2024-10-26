<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportProductRequest;
use App\Http\Requests\UpdateReportProductRequest;
use App\Models\ReportProduct;

class ReportProductController extends Controller
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
     * @param  \App\Http\Requests\StoreReportProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReportProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportProduct  $reportProduct
     * @return \Illuminate\Http\Response
     */
    public function show(ReportProduct $reportProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportProduct  $reportProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportProduct $reportProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReportProductRequest  $request
     * @param  \App\Models\ReportProduct  $reportProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReportProductRequest $request, ReportProduct $reportProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportProduct  $reportProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportProduct $reportProduct)
    {
        //
    }
}
