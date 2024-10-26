<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlansRequest;
use App\Http\Requests\UpdatePlansRequest;
use App\Models\Plans;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->plan) {
            $plans = Plans::find($request->plan);
        } else {
            $plans = Plans::all();
        }
        return Controller::responder(true, "Success", $plans);
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
     * @param  \App\Http\Requests\StorePlansRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlansRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plans  $plans
     * @return \Illuminate\Http\Response
     */
    public function show(Plans $plans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plans  $plans
     * @return \Illuminate\Http\Response
     */
    public function edit(Plans $plans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlansRequest  $request
     * @param  \App\Models\Plans  $plans
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlansRequest $request, Plans $plans)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plans  $plans
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plans $plans)
    {
        //
    }
}
