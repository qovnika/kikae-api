<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportStoreRequest;
use App\Http\Requests\UpdateReportStoreRequest;
use App\Models\ReportStore;

class ReportStoreController extends Controller
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
     * @param  \App\Http\Requests\StoreReportStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReportStoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportStore  $reportStore
     * @return \Illuminate\Http\Response
     */
    public function show(ReportStore $reportStore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportStore  $reportStore
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportStore $reportStore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReportStoreRequest  $request
     * @param  \App\Models\ReportStore  $reportStore
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReportStoreRequest $request, ReportStore $reportStore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportStore  $reportStore
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportStore $reportStore)
    {
        //
    }
}
