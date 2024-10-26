<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Store;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public $user;

    public function __construct () {
        $this->middleware('auth:sanctum');
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user_id) {
            $transaction = Transaction::where("user_id", $request->user_id)->orderBy("id", "DESC")->get();
        } elseif ($request->store_id) {
            $transaction = Transaction::where("store_id", $request->store_id)->orderBy("id", "DESC")->get();
        } else {
            $transaction = Transaction::orderBy("id", "DESC")->get();
        }

        return Controller::responder(true, "Successfully retrieved transactions.", $transaction);
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
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $request->validate([
            "tx_ref" => ["required", "string"],
            "transaction_id" => ["required", "string"],
            "status" => ["required", "string"]
        ]);

        $trans = Transaction::create([
            "tx_ref" => $request->tx_ref,
            "transaction_id" => $request->transaction_id,
            "status" => $request->status,
            "user_id" => $request->user_id ? $request->user_id : 1,
            "amount" => $request->amount,
            "delivery_address" => $request->delivery_address
        ]);

        foreach ($request->orders as $order) {
            $order = json_encode($order);
            $order = json_decode($order);
            $creator = [
                "product_id" => $order->product_id,
                "units" => $order->units,
                "name" => $order->name,
                "price" => $order->price,
                "size" => $order->size,
                "transaction_id" => $trans->id,
                "colour" => isset($order->colour) && isset($order->colour->id) ? $order->colour->id : NULL,
                "drawing" => isset($order->drawing) && isset($order->drawing->id) ? $order->drawing->id : NULL,
                "fabric" => isset($order->fabric) && isset($order->fabric->id) ? $order->fabric->id : NULL,
                "location" => isset($order->location) && $order->location != 0 ? $order->location : NULL,
                "latitude" => isset($order->latitude) ? $order->latitude : NULL,
                "longitude" => isset($order->longitude) ? $order->longitude : NULL,
                "logistic_id" => isset($order->logistic_id) && $order->logistic_id != 0 ? $order->logistic_id : NULL,
            ];

            if (isset($order->colour->id)) {
                array_merge($creator, ["colour" => $order->colour->id]);
            }

            if (isset($order->drawing->id)) {
                array_merge($creator, ["drawing" => $order->drawing->id]); 
            }

            if (property_exists($order->fabric, "id")) {
                array_merge($creator, ["fabric" => $order->fabric->id]); 
            }

            if (isset($order->location->id)) {
                array_merge($creator, ["location" => $order->location->id]); 
            }

            if (isset($order->area_id)) {
                array_merge($creator, ["area_id" => $order->area_id]); 
            }

            if (isset($order->delivery_address)) {
                array_merge($creator, ["delivery_address" => $order->delivery_address]);
            }

            $order = Order::create($creator);
            $orders[] = $order;
            
            $product = Product::find($order->product_id);
    	    $product->units -= $request->units;
	        $product->save();

            //Get store associated with Product in order to send notification to store owner
            $store = Store::find($product->store_id);
            if (isset($order->area_id)) {
            	$destination = LogisticDestination::where("area_id", $order->area_id)->get();
            	$store->balance = $store->balance + (($order->price * $order->units) - $destination->cost);
            } else {
	            $store->balance += $order->price * $order->units;            
            }

            $store->save();

            //Send notification to store regarding order placed on their store
            Mail::to(Auth::user()->email)->send(new OrderPlaced($order, $store->user_id));
        }

        $trans->orders = $orders;

        return Controller::responder(true, "Your transaction has been successfully stored.", $trans);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $request->validate([
            "tx_ref" => ["required", "string"],
            "transaction_id" => ["required", "string"],
            "id" => ["required"]
        ]);

        $transaction = Transaction::find($request->id);
        if ($request->status == "Delivered") {
            $transaction->settled = true;
        }
        $transaction->status = $request->status;
        $transaction->save();

        Controller::responder(true, "Successfully updated transaction.", $transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
