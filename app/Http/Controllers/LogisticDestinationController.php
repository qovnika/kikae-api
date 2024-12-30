<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogisticDestinationRequest;
use App\Http\Requests\UpdateLogisticDestinationRequest;
use App\Models\LogisticDestination;
use Illuminate\Http\Request;

class LogisticDestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Get Logistic destinations endpoint - POST request query parameters:,
     *     description: Get Logistics destinations endpoint - Parameters for POST request must have the logistic company id { id },
     *     tags: Logistics
     * })
     * @Response(
     *    code: 200
     *    ref: LogisticDestination
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id) {
            $logistic = LogisticDestination::find($request->id);
        } elseif ($request->logistic_id) {
        	$logistic = LogisticDestination::where("logistic_id", $request->logistic_id)->orderBy("area", "ASC")->get();
        } else {
            $logistic = LogisticDestination::all();
        }

        return Controller::responder(true, "Successfully retrieved logistic company destinations.", $logistic);
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
     *     summary: Create Logistic destination endpoint - POST request query parameters,
     *     description: Create Logistics destination endpoint - Parameters for POST request must have the Logistic company id, state id, area and cost { logistic_id && state_id && area && cost },
     *     tags: Logistics
     * })
     * @Response(
     *    code: 200
     *    ref: LogisticDestination
     * )
     *
     * @param  \App\Http\Requests\StoreLogisticDestinationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogisticDestinationRequest $request)
    {
        $request->validate([
            "state_id" => "required",
            "logistic_id" => "required",
            "area" => "required",
            "cost" => "required"
        ]);

        $logistic = LogisticDestination::create([
            "state_id" => $request->state_id,
            "area" => $request->area,
            "logistic_id" => $request->logistic_id,
            "cost" => $request->cost,
        ]);

        return Controller::responder(true, "Successfully added the Logistic company destination.", $logistic);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LogisticDestination  $logisticDestination
     * @return \Illuminate\Http\Response
     */
    public function show(LogisticDestination $logisticDestination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LogisticDestination  $logisticDestination
     * @return \Illuminate\Http\Response
     */
    public function edit(LogisticDestination $logisticDestination)
    {
    	//
    }

    /**
     * Update the specified resource in storage.
     *
     * @Request({
     *     summary: Update Logistic destination endpoint - POST request query parameters,
     *     description: Update Logistics destination endpoint - Parameters for POST request must have the logistic destination id, Logistic company id, state id, area and cost { id && logistic_id && state_id && area && cost },
     *     tags: Logistics
     * })
     * @Response(
     *    code: 200
     *    ref: LogisticDestination
     * )
     *
     * @param  \App\Http\Requests\UpdateLogisticDestinationRequest  $request
     * @param  \App\Models\LogisticDestination  $logisticDestination
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLogisticDestinationRequest $request, LogisticDestination $logisticDestination)
    {
        $request->validate([
            "state_id" => "required",
            "logistic_id" => "required",
            "area" => "required",
            "cost" => "required",
            "id" => "required|exists:logistic_destination,id"
        ]);

        $logistic = LogisticDestination::find($request->id);
        $logistic->state_id = $request->state_id;
        $logistic->logistic_id = $request->logistic_id;
        $logistic->area = $request->area;
        $logistic->cost = $request->cost;

        $logistic->save();

        return Controller::responder(true, "Successfully updated the Logistic company destination.", $logistic);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Request({
     *     summary: Delete Logistic destination endpoint - POST request query parameters,
     *     description: Delete Logistics destination endpoint - Parameters for POST request must have the logistic destination id { id },
     *     tags: Logistics
     * })
     * @Response(
     *    code: 200
     *    ref: LogisticDestination
     * )
     *
     * @param  \App\Models\LogisticDestination  $logisticDestination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $logistic = LogisticDestination::find($request->id);
        $log = $logistic;

        $logistic->delete();

        return Controller::responder(true, "Successfully deleted this Logistic company destination.", $log);
    }
}
