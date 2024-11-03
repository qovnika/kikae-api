<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Get cart endpoint - POST request query parameters:,
     *     description: Get cart endpoint - Parameters for POST request: {user_id},
     *     tags: Cart
     * })
     * @Response(
     *    code: 200
     *    ref: Cart
     * )
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cart = Cart::where("user_id", $request->user_id)->get()->unique();
        return Controller::responder(true, "Successfully retrieved user's cart.", $cart);
    }

    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Get cart item endpoint - POST request query parameters:,
     *     description: Get cart item endpoint - Parameters for POST request: {id},
     *     tags: Cart
     * })
     * @Response(
     *    code: 200
     *    ref: Cart
     * )
     * @return \Illuminate\Http\Response
     */
    public function getCartItem (Request $request)
    {
        $cart = Cart::find($request->id);
        return Controller::responder(true, "Successfully retrieved cart item.", $cart);        
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
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        $request->validate([
            "user_id" => ["required"],
            "units" => ["required"]
        ]);

        $data = [
            "user_id" => $request->user_id,
        ];

        if ($request->size_id) {
            array_push($data, ["size_id" => $request->size_id]);
        }

        if ($request->color_id) {
            array_push($data, ["color_id" => $request->color_id]);
        }

        if ($request->location_id) {
            array_push($data, ["location_id" => $request->location_id]);
        }

        if ($request->drawing_id) {
            array_push($data, ["drawing_id" => $request->drawing_id]);
        }

        if ($request->fabric_id) {
            array_push($data, ["fabric_id" => $request->fabric_id]);
        }

        $cart = Cart::create($data);
        $cart = Cart::where("user_id", $request->user_id)->get()->unique();

        return Controller::responder(true, "Successfully added to cart.", $cart);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Update cart item endpoint - POST request query parameters:,
     *     description: Update cart item endpoint - Parameters for POST request must have cart item id {id},
     *     tags: Cart
     * })
     * @Response(
     *    code: 200
     *    ref: Cart
     * )
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $request->validate([
            "units" => ["required"]
        ]);

        $cart = Cart::find($request->id);

        if ($request->size_id) {
            $cart->size_id = $request->size_id;            
        }

        if ($request->location_id) {
            $cart->location_id = $request->location_id;            
        }

        if ($request->color_id) {
            $cart->color_id = $request->color_id;            
        }

        if ($request->fabric_id) {
            $cart->fabric_id = $request->fabric_id;            
        }

        if ($request->drawing_id) {
            $cart->drawing_id = $request->drawing_id;            
        }

        $cart->save();

        return Controller::responder(true, "Successfully updated cart item.", $cart);
    }

    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Delete cart item endpoint - POST request query parameters:,
     *     description: Delete cart item endpoint - Parameters for POST request must have cart item id {id},
     *     tags: Cart
     * })
     * @Response(
     *    code: 200
     *    ref: Cart
     * )
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart(Request $request)
    {
        $cart = Cart::find($request->id);
        $cart->delete();

        return Controller::responder(true, "Deleted successfully.", []);
    }

    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Remove cart endpoint - POST request query parameters:,
     *     description: Remove cart endpoint - Parameters for POST request must have user id {user_id},
     *     tags: Cart
     * })
     * @Response(
     *    code: 200
     *    ref: Cart
     * )
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function deleteCart(Request $request)
    {
        $cart = Cart::where("user_id", $request->user_id)->get();
        $cart->delete();

        return Controller::responder(true, "Deleted successfully.", []);
    }
}
