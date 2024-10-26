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

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user_id) {
            $orders = Order::withWhereHas("transaction", function ($query) use ($request) {
                $query->where("user_id", $request->user_id);
            })->orderBy("id", "DESC")->get();
        } elseif ($request->store_id) {
            $orders = Order::withWhereHas("product", function ($query) use ($request) {
                $query->where("store_id", $request->store_id);
            })->orderBy("id", "DESC")->get();
            /*            $orders = DB::select("select * from `orders` where exists (select * from `products` where `orders`.`product_id` = `products`.`id` and `store_id` = '".$request->store_id."') order by `id` desc");	*/
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
