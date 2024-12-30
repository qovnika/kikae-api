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
     * @Request({
     *     summary: Create plans endpoint - POST request query parameters,
     *     description: Create plans endpoint - Parameters for POST request must have the price,
     *     tags: Plan
     * })
     * @Response(
     *    code: 200
     *    ref: Plans
     * )
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
     * @Request({
     *     summary: Create plan endpoint - POST request query parameters:,
     *     description: Create plan endpoint - Parameters for POST request must have the price, units, product id, note, name and user id. The following fields are optional (size || colour || drawing || fabric || location || logistic_id || status || settled || longitude || latitude || transaction_id || delivery address || area_id){ price && units && product_id && note && name && user_id || size || colour || drawing || fabric || location || logistic_id || status || settled || longitude || latitude || transaction_id || delivery address || area_id },
     *     tags: Plan
     * })
     * @Response(
     *    code: 200
     *    ref: Plans
     * )
     *
     * @param  \App\Http\Requests\StorePlansRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlansRequest $request)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "price" => "required"
        ]);

        $plan = Plans::create([
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price
        ]);

        return Controller::responder(true, "Successfully created plan.", $plan);
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
     * @Request({
     *     summary: Update plan endpoint - POST request query parameters:,
     *     description: Update plan endpoint - Parameters for POST request must have the price, units, product id, note, name and user id. The following fields are optional (size || colour || drawing || fabric || location || logistic_id || status || settled || longitude || latitude || transaction_id || delivery address || area_id){ price && units && product_id && note && name && user_id || size || colour || drawing || fabric || location || logistic_id || status || settled || longitude || latitude || transaction_id || delivery address || area_id },
     *     tags: Plan
     * })
     * @Response(
     *    code: 200
     *    ref: Plans
     * )
     *
     * @param  \App\Http\Requests\UpdatePlansRequest  $request
     * @param  \App\Models\Plans  $plans
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlansRequest $request, Plans $plans)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "price" => "required"
        ]);

        $plan = Plans::find($request->id);
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->price = $request->price;

        return Controller::responder(true, "Successfully created plan.", $plan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Request({
     *     summary: Delete plan endpoint - POST request query parameters,
     *     description: Delete Plan endpoint - Parameters for POST request must have the plan id { id },
     *     tags: Plan
     * })
     * @Response(
     *    code: 200
     *    ref: Plans
     * )
     *
     * @param  \App\Models\Plans  $plans
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $plans)
    {
        $plan = Plans::find($plans->id);
        $plan_old = $plan;
        $plan->delete();

        return Controller::responder(true, "Successfully deleted plan.", $plan_old);
    }
}
