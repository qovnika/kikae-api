<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransferRequest;
use App\Http\Requests\UpdateTransferRequest;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->store_id) {
            $transfers = Transfer::where("store_id", $request->store_id);
            return Controller::responder(true, "Successfully retrieved store transfers.", $transfers);
        } else {
            $transfers = Transfer::all()->sortByDesc("id");
            return Controller::responder(true, "Successfully retrieved store transfers.", $transfers);
        }
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
     * @param  \App\Http\Requests\StoreTransferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransferRequest  $request
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferRequest $request, Transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        //
    }

        /**
     * Initiate paystack transfer
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function initiatePaystackTransfer (Request $request) {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer sk_test_ff6ab47e9c162122c52b2b2e7c61ec6e2f7b7026"
        ])->post(
            'https://api.paystack.co/transfer',
            $request
        );
    
        return $response;    
    }

    /**
     * Finalize paystack transfer
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

     public function finalizePaystackTransfer (Request $request) {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer sk_test_ff6ab47e9c162122c52b2b2e7c61ec6e2f7b7026"
        ])->post(
            'https://api.paystack.co/transfer/finalize_transfer',
            $request
        );
    
        return $response;    
    }

    /**
     * Verify paystack payment
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

     public function verifyPaystackTransfer (Request $request) {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer sk_test_ff6ab47e9c162122c52b2b2e7c61ec6e2f7b7026"
        ])->get(
            'https://api.paystack.co/transfer/verify/'.$request->reference,
            $request
        );
    
        return $response;    
    }

    /**
     * List paystack payment
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

     public function listPaystackTransfer (Request $request) {
        $response = Http::withHeaders([
            "Authorization" => "Bearer sk_test_ff6ab47e9c162122c52b2b2e7c61ec6e2f7b7026"
        ])->get(
            'https://api.paystack.co/transfer',
            $request
        );
    
        return $response;    
    }

    /**
     * Fetch paystack transfer
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

     public function fetchPaystackTransfer (Request $request) {
        $response = Http::withHeaders([
            "Authorization" => "Bearer sk_test_ff6ab47e9c162122c52b2b2e7c61ec6e2f7b7026"
        ])->get(
            'https://api.paystack.co/transfer/'.$request->code,
            $request
        );
    
        return $response;    
    }

}
