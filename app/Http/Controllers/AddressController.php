<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Get user's addresses endpoint - POST request query parameters,
     *     description: Get user's addresses endpoint - Parameters for POST request must provide user ID or State ID { user_id || state_id },
     *     tags: User
     * })
     * @Response(
     *    code: 200
     *    ref: Address
     * )
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->state_id) {
            $addresses = Address::where("state_id", $request->state_id)->orderBy("id", "DESC")->get();
            return Controller::responder(true, "Successfully retrieved addresses.", $addresses);
        } elseif ($request->user_id) {
            $addresses = Address::where("user_id", $request->user_id)->orderBy("id", "DESC")->get();
            return Controller::responder(true, "Successfully retrieved addresses.", $addresses);
        } else {
            $addresses = Address::all();
            return Controller::responder(true, "Successfully retrieved addresses.", $addresses);
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
     *     summary: Add user's address endpoint - POST request query parameters,
     *     description: Add user's address endpoint - Parameters for POST request must have User ID, State ID and address. { user_id && state_id && address },
     *     tags: User
     * })
     * @Response(
     *    code: 200
     *    ref: Address
     * )
     *
     * @param  \App\Http\Requests\StoreAddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        $request->validate([
            "user_id" => "required",
            "state_id" => "required",
            "address" => "required"
        ]);

        $address = Address::create([
            "user_id" => $request->user_id,
            "state_id" => $request->state_id,
            "address" => $request->address
        ]);

        return Controller::responder(true, "Successfully added user's address.", $address);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @Request({
     *     summary: Update user's address endpoint - POST request query parameters,
     *     description: Update user's address endpoint - Parameters for POST request must have the address's ID, State ID and address. { id && state_id && address },
     *     tags: User
     * })
     * @Response(
     *    code: 200
     *    ref: Address
     * )
     *
     * @param  \App\Http\Requests\UpdateAddressRequest  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        $request->validate([
            "id" => "required",
            "user_id" => "required",
            "state_id" => "required",
            "address" => "required"
        ]);

        $address = Address::find($request->id);
        $address->state_id = $request->state_id;
        $address->address = $request->address;

        return Controller::responder(true, "Successfully updated the user's address.", $address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Request({
     *     summary: Delete user's address endpoint - POST request query parameters,
     *     description: Delete user's address endpoint - Parameters for POST request must have the address's ID { id },
     *     tags: User
     * })
     * @Response(
     *    code: 200
     *    ref: Address
     * )
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $address = Address::find($request->id);

        $address_old = $address;
        $address->delete();

        return Controller::responder(true, "Successfully deleted the user's address.", $address_old);
    }
}
