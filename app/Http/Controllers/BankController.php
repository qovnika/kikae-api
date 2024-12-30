<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBankRequest;
use App\Http\Requests\UpdateBankRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Bank;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Get Bank account details endpoint - POST request query parameters:,
     *     description: Get Bank account details register endpoint - Parameters for POST request must have the store id { store_id },
     *     tags: Banks
     * })
     * @Response(
     *    code: 200
     *    ref: Bank
     * )
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id) {
            $banks = Bank::where("store_id", $request->id);
            return Controller::responder(true, "Successfully retrieved bank accounts.", $banks);
        } else {
            $banks = Bank::all();
            return Controller::responder(true, "Successfully retrieved bank accounts.", $banks);
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
     * @Request({
     *     summary: Create Bank account details endpoint - POST request query parameters:,
     *     description: Create Bank account details register endpoint - Parameters for POST request must have the store id, bank name, account number, account name, recepient code, bank code { bank_name && account_number && account_name && recepient_code && bank_code && store_id },
     *     tags: Banks
     * })
     * @Response(
     *    code: 200
     *    ref: Bank
     * )
     * 
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\StoreBankRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankRequest $request)
    {
        $recepient = $this->createRecepient($request)->data;

        if ($recepient) {
        	$account = Bank::create([
        		"name" => $recepient->details->bank_name,
        		"number" => $request->account_number,
        		"account_name" => $request->name,
        		"recepient" => $recepient->recipient_code,
        		"store_id" => $request->store_id,
                "bank_code" => $request->bank_code
        	]);
        }
        
        return Controller::responder(true, "Bank account added successfully." , $account);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBankRequest  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankRequest $request, Bank $bank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Request({
     *     summary: Delete Bank account details endpoint - POST request query parameters:,
     *     description: Delete Bank account details register endpoint - Parameters for POST request must have the bank account id { id },
     *     tags: Banks
     * })
     * @Response(
     *    code: 200
     *    ref: Bank
     * )
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $bank = Bank::find($request->id);
        if ($bank->delete()) {
            return Controller::responder(true, "Bank deleted successfully.", []);
        } else {
            return Controller::responder(false, "Bank could not be deleted.", []);
        }
    }

    /**
     * Get Nigerian (NGN) banks from paystack
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function getPaystackBanks (Request $request) {
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Authorization" => "Bearer sk_test_ff6ab47e9c162122c52b2b2e7c61ec6e2f7b7026"
        ])->get(
            'https://api.paystack.co/bank?currency=NGN',
            $request
        );
    
        return $response;    
    }

    /**
     * Resolve Nigerian (NGN) bank account from paystack
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

     public function resolveAccountDetails (Request $request) {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer sk_test_ff6ab47e9c162122c52b2b2e7c61ec6e2f7b7026"
        ])->get(
            'https://api.paystack.co/bank/resolve?account_number='.$request->number."&bank_code=".$request->bank,
            $request
        );
    
        return $response;    
    }

    /**
     * Create paystack transfer recepient
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

     public function createRecepient (Request $request) {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer sk_test_ff6ab47e9c162122c52b2b2e7c61ec6e2f7b7026"
        ])->post(
            'https://api.paystack.co/transferrecipient',
            $request
        );
    
        return json_decode($response);    
    }

}
