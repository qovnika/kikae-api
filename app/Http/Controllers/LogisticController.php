<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogisticRequest;
use App\Http\Requests\UpdateLogisticRequest;
use Illuminate\Http\Request;
use App\Models\Logistic;

class LogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id) {
            $logistic = Logistic::find($request->id);
        } else {
            $logistic = Logistic::all();
        }

        return Controller::responder(true, "Successfully retrieved logistic companies.", $logistic);
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
     * @param  \App\Http\Requests\StoreLogisticRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogisticRequest $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "phone" => "required",
            "address" => "required"
        ]);

        $logistic = Logistic::create([
            "name" => $request->name,
            "phone" => $request->phone,
            "address" => $request->address,
            "email" => $request->email,
        ]);

        return Controller::responder(true, "Successfully created the Logistic company.", $logistic);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function show(Logistic $logistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function edit(Logistic $logistic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLogisticRequest  $request
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLogisticRequest $request, Logistic $logistic)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "phone" => "required",
            "address" => "required"
        ]);

        $logistic = Logistic::find($request->id);
        $logistic->name = $request->name;
        $logistic->email = $request->email;
        $logistic->phone = $request->phone;
        $logistic->address = $request->address;

        $logistic->save();

        return Controller::responder(true, "Successfully updated the Logistic company.", $logistic);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $logistic = Logistic::find($request->id);
        $log = $logistic;

        $logistic->delete();

        return Controller::responder(true, "Successfully deleted Logistic company.", $log);
    }
}
