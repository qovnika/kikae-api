<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Store;
use App\Models\LogisticDestination;
use App\Models\ArtistAvailable;
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
     * @Request({
     *     summary: Get Transactions endpoint - POST request query parameters:,
     *     description: Get Transactions register endpoint - Parameters for POST request must have the store id or user id { store_id || user_id },
     *     tags: Transactions
     * })
     * @Response(
     *    code: 200
     *    ref: Transaction
     * )
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
     * @Request({
     *     summary: Create Transaction endpoint - POST request query parameters,
     *     description: Create Transaction endpoint - Parameters for POST request must have the transaction reference, transaction id, status, amount, delivery address, user id and orders array { tx_ref && transaction_id && status && amount && address && user_id && orders[] }. Refer to the Order endpoint for parameters to pass for the orders in the array,
     *     tags: Transactions
     * })
     * @Response(
     *    code: 200
     *    ref: Transaction
     * )
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
//                "size" => $order->size,
                "transaction_id" => $trans->id,
                "size" => isset($order->size) && isset($order->size->id) ? $order->size->id : NULL,
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

            if (isset($order->fabric->id)) {
                array_merge($creator, ["fabric" => $order->fabric->id]); 
            }

            if (isset($order->location->id)) {
                array_merge($creator, ["location" => $order->location->id]); 
            }

            if (isset($order->size->id)) {
                array_merge($creator, ["size" => $order->size->id]); 
            }

            if (isset($order->area_id)) {
                array_merge($creator, ["area_id" => $order->area_id]); 
            }

            if (isset($order->delivery_address)) {
                array_merge($creator, ["delivery_address" => $order->delivery_address]);
            }

            if (isset($order->top_length)) {
                array_merge($creator, ["top_length" => $order->top_length]);
            }
    
            if (isset($order->shoulder_length)) {
                array_merge($creator, ["shoulder_length" => $order->shoulder_length]);
            }
    
            if (isset($order->neck_length)) {
                array_merge($creator, ["neck_length" => $order->neck_length]);
            }
    
            if (isset($order->sleeves)) {
                array_merge($creator, ["sleeves" => $order->sleeves]);
            }
    
            if (isset($order->biceps)) {
                array_merge($creator, ["biceps" => $order->biceps]);
            }
    
            if (isset($order->armors)) {
                array_merge($creator, ["armors" => $order->armors]);
            }
    
            if (isset($order->waist_length)) {
                array_merge($creator, ["waist_length" => $order->waist_length]);
            }
    
            if (isset($order->bottom_length)) {
                array_merge($creator, ["bottom_length" => $order->bottom_length]);
            }
    
            if (isset($order->ankle_width)) {
                array_merge($creator, ["ankle_width" => $order->ankle_width]);
            }
    
            if (isset($order->thigh)) {
                array_merge($creator, ["thigh" => $order->thigh]);
            }

            if (isset($order->availability)) {
                $availability = ArtistAvailable::create([
                    "store_id" => $order->store_id,
                    "product_id" => $order->product_id,
                    "dated" => $order->availability,
                    "available" => false
                ]);
                array_merge($creator, ["available_id" => $availability->id]);
            }
    
            if (isset($order->available_id)) {
                array_merge($creator, ["available_id" => $order->available_id]);
            }

            $order = Order::create($creator);
            $orders[] = $order;
            
            $product = Product::find($order->product_id);
    	    $product->units -= $order->units;
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
     * @Request({
     *     summary: Create Transaction endpoint - POST request query parameters,
     *     description: Create Transaction endpoint - Parameters for POST request must have the transaction reference, transaction id, status, and id { tx_ref && transaction_id && status && id },
     *     tags: Transactions
     * })
     * @Response(
     *    code: 200
     *    ref: Transaction
     * )
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
