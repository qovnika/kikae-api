<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use \Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Get orders endpoint - POST request query parameters:,
     *     description: Get orders endpoint - Parameters for POST request must have the order ID, store id or user id { store_id || user_id || id || month || year || (month && year) },
     *     tags: Transaction
     * })
     * @Response(
     *    code: 200
     *    ref: Order
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id) {
            $orders = Order::find($request->id);
        } elseif ($request->user_id) {
            $orders = Order::withWhereHas("transaction", function ($query) use ($request) {
                $query->where("user_id", $request->user_id);
            })->orderBy("id", "DESC")->get();
        } elseif ($request->store_id) {
            $orders = Order::withWhereHas("product", function ($query) use ($request) {
                $query->where("store_id", $request->store_id);
            })->orderBy("id", "DESC")->get();
        } elseif ($request->year && $request->month) {
            $orders = Order::whereYear("created_at", Carbon::parse($request->year)->month())->whereMonth("created_at", Carbon::parse($request->month)->month())->get();
        } elseif ($request->month) {
            $orders = Order::whereMonth("created_at", Carbon::parse($request->month)->month())->get();
        } elseif ($request->year) {
            $orders = Order::whereYear("created_at", Carbon::parse($request->year)->month())->get();
        } else {
            $orders = Order::orderBy("id", "DESC")->get();
        }

        return Controller::responder(true, "Successfully retrieved orders.", $orders);
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
     *     summary: Create orders endpoint - POST request query parameters,
     *     description: Create orders endpoint - Parameters for POST request must have the price, units, product id, note, name and user id. The following fields are optional (size || colour || drawing || fabric || location || logistic_id || status || settled || longitude || latitude || transaction_id || delivery address || area_id){ price && units && product_id && note && name && user_id || size || colour || drawing || fabric || location || logistic_id || status || settled || longitude || latitude || transaction_id || delivery address || area_id || top_length || shoulder_length || top_length || neck_length || arm_length || arm_width || belly_length || waist_length || bottom_length || ankle_width || thigh || availability || available_id },
     *     tags: Transaction
     * })
     * @Response(
     *    code: 200
     *    ref: Order
     * )
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $request->validate([
            "price" => ["required", "string"],
            "units" => ["required", "string"],
            "product_id" => ["required", "exists:products,id"],
            "user_id" => ["required", "exists:users,id"]
        ]);

        $order = Order::create([
            "price" => $request->price,
            "units" => $request->units,
            "product_id" => $request->product_id,
            "user_id" => $request->user_id
        ]);

        return response("The order has been successfully placed.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @Request({
     *     summary: Update orders endpoint - POST request query parameters:,
     *     description: Update orders endpoint - Parameters for POST request must have the price, units, product id, note, name and user id. The following fields are optional: (size || colour || drawing || fabric || location || logistic_id || status || settled || longitude || latitude || transaction_id || delivery address || area_id) - { price && units && product_id && note && name && user_id || size || colour || drawing || fabric || location || logistic_id || status || settled || longitude || latitude || transaction_id || delivery address || area_id || [ size_id || color_id || fabric_id || location_id drawing_id || top_length || shoulder_length || top_length || neck_length || arm_length || arm_width || belly_length || waist_length || bottom_length || ankle_width || thigh || <(availability || available_id) && product_id > ] },
     *     tags: Transaction
     * })
     * @Response(
     *    code: 200
     *    ref: Order
     * )
     *
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $request->validate([
            "id" => ["required"],
            "status" => ["required"]
        ]);

        $order = Order::find($request->id);
        $order->status = $request->status;
        if ($order->status == "Delivered") {
            $order->settled = true;
        }

        $order->save();

        //Send notification to customer regarding the status of the order
        if ($order->status == "Dispatched") {
            Mail::to($order->transaction->user->email)->send(new OrderPlaced($order, $order->transaction->user_id));
        }
        return Controller::responder(true, "The order has been successfully updated.", $order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
