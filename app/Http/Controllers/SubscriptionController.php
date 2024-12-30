<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Plans;
use App\Models\Subscription;

class SubscriptionController extends Controller
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
     *     summary: Create subscriptions endpoint - POST request query parameters,
     *     description: Create subscriptions endpoint - Parameters for POST request must have the transactin_id, status, store id, tx_ref, price, plan_id. { store_id, transaction_id, tx_ref, status, price, plan_id },
     *     tags: Subscription
     * })
     * @Response(
     *    code: 200
     *    ref: Subscription
     * )
     *
     * @param  \App\Http\Requests\StoreSubscriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriptionRequest $request)
    {
        $plan = Plans::find($request->plan_id);
        $subscription = Subscription::create([
            "store_id" => $request->store_id,
            "tx_ref" => $request->tx_ref,
            "transaction_id" => $request->transaction_id,
            "status" => $request->status,
            "price" => $request->price,
            "plan_id" => $request->plan_id
        ]);
        $subscription->name = $plan->name;
        $subscription->plan = Plans::find($plan->id);

        return Controller::responder(true, "Subscription successful.", $subscription);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubscriptionRequest  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
