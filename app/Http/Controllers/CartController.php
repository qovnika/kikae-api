<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ArtistAvailable;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Get cart endpoint - POST request query parameters:,
     *     description: Get cart endpoint - Parameters for POST request must provide user ID {user_id},
     *     tags: Cart
     * })
     * @Response(
     *    code: 200
     *    ref: Cart
     * )
     * 
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
     *     description: Get cart item endpoint - Parameters for POST request must contain cart ID {id},
     *     tags: Cart
     * })
     * @Response(
     *    code: 200
     *    ref: Cart
     * )
     * 
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
     * @Request({
     *     summary: Add to cart item endpoint - POST request query parameters,
     *     description: Add to cart item endpoint - Parameters for POST request must have user id and units. Optionally you may pass size id, location id, color id, drawing id, fabric id { user_id && units || [ size_id || color_id || fabric_id || location_id drawing_id || top_length || shoulder_length || top_length || neck_length || arm_length || sleeves || biceps || armors || bottom_length || ankle_width || thigh || <(availability || available_id) && product_id > ] },
     *     tags: Cart
     * })
     * @Response(
     *    code: 200
     *    ref: Cart
     * )
     *
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        $request->validate([
            "user_id" => "required|exists:users,id",
            "product_id" => "required|exists:products,id",
            "units" => "required"
        ]);

        $data = [
            "user_id" => $request->user_id,
            "product_id" => $request->product_id
        ];

        if ($request->size_id) {
            array_merge($data, ["size_id" => $request->size_id]);
        }

        if ($request->color_id) {
            array_merge($data, ["color_id" => $request->color_id]);
        }

        if ($request->location_id) {
            array_merge($data, ["location_id" => $request->location_id]);
        }

        if ($request->drawing_id) {
            array_merge($data, ["drawing_id" => $request->drawing_id]);
        }

        if ($request->fabric_id) {
            array_merge($data, ["fabric_id" => $request->fabric_id]);
        }

        if ($request->top_length) {
            array_merge($data, ["top_length" => $request->top_length]);
        }

        if ($request->shoulder_length) {
            array_merge($data, ["shoulder_length" => $request->shoulder_length]);
        }

        if ($request->neck_length) {
            array_merge($data, ["neck_length" => $request->neck_length]);
        }

        if ($request->arm_length) {
            array_merge($data, ["sleeves" => $request->arm_length]);
        }

        if ($request->arm_width) {
            array_merge($data, ["biceps" => $request->arm_width]);
        }

        if ($request->belly_length) {
            array_merge($data, ["armors" => $request->belly_length]);
        }

        if ($request->waist_length) {
            array_merge($data, ["waist_length" => $request->waist_length]);
        }

        if ($request->bottom_length) {
            array_merge($data, ["bottom_length" => $request->bottom_length]);
        }

        if ($request->ankle_width) {
            array_merge($data, ["ankle_width" => $request->ankle_width]);
        }

        if ($request->thigh) {
            array_merge($data, ["thigh" => $request->thigh]);
        }

        if ($request->availability) {
            $availability = ArtistAvailable::create([
                "store_id" => $request->store_id,
                "product_id" => $request->product_id,
                "dated" => $request->availability
            ]);
            array_merge($data, ["available_id" => $availability->id]);
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
     * Update the specified resource in storage.
     *
     * @Request({
     *     summary: Update cart item endpoint - POST request query parameters:,
     *     description: Update cart item endpoint - Parameters for POST request must have user id and units. Optionally you may pass size id, location id, color id, drawing id, fabric id { user_id && units | [ size_id || color_id || fabric_id || location_id drawing_id || top_length || shoulder_length || top_length || neck_length || arm_length || sleeves || biceps || armors || bottom_length || ankle_width || thigh ] },
     *     tags: Cart
     * })
     * @Response(
     *    code: 200
     *    ref: Cart
     * )
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $request->validate([
            "user_id" => "required|exists:users,id",
            "product_id" => "required|exists:products,id",
            "units" => "required",
            "id" => "required|exists:carts,id"
        ]);

        $cart = Cart::find($request->id);
        $cart->units = $request->units;

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

        if ($request->top_length) {
            $cart->top_length = $request->top_length;
        }

        if ($request->shoulder_length) {
            $cart->shoulder_length = $request->shoulder_length;
        }

        if ($request->neck_length) {
            $cart->neck_length = $request->neck_length;
        }

        if ($request->sleeves) {
            $cart->sleeves = $request->sleeves;
        }

        if ($request->biceps) {
            $cart->biceps = $request->biceps;
        }

        if ($request->armors) {
            $cart->armors = $request->armors;
        }

        if ($request->waist_length) {
            $cart->waist_length = $request->waist_length;
        }

        if ($request->bottom_length) {
            $cart->bottom_length = $request->bottom_length;
        }

        if ($request->ankle_width) {
            $cart->ankle_width = $request->ankle_width;
        }

        if ($request->thigh) {
            $cart->thigh = $request->thigh;
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
