<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Get Product endpoint - GET request query parameters: {all=1},
     *     description: Get product endpoint - Parameters for POST request: {category_id, store_id},
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: Store
     * )
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user_id) {
            return Store::where("user_id", $request->user_id)->get()->unique();
        } elseif ($request->category_id) {
            return Store::orderBy("id", "DESC")->where("category_id", $request->category_id);
        } elseif($request->id) {
            return Store::find($request->id);
        } elseif ($request->all) {
            $stores = Store::with("ratings")->get()->unique();

            return Controller::responder(true, "Successfully retrieved all stores.", $stores);
        } else {
            $stores = Store::with(["ratings", "transactions"]);
            
            $houses = json_encode($stores);
            $houses = json_decode($houses);
            $houses = $houses->data;
            //Sort stores by subscription plan
            for ($i = 0; $i < count($houses); $i++) {
            	$highest = $i;
            	$store_subs = count($houses[$i]->subscriptions);
            	for ($j = $i + 1; $j < count($houses); $j++) {
            		$subs = count($houses[$j]->subscriptions);
            		if ($subs > 0 && $store_subs > 0 && $houses[$j]->subscriptions[$subs - 1]->plan_id > $houses[$i]->subscriptions[$store_subs - 1]->plan_id) {
            			$highest = $j;
            		}
            	}
            	$subs = count($houses[$highest]->subscriptions);
            	if ($subs > 0 && $store_subs > 0 && $houses[$i]->subscriptions[$store_subs - 1]->plan_id < $houses[$highest]->subscriptions[$store_subs - 1]->plan_id) {
            		$hold = $houses[$i];
            		$houses[$i] = $houses[$highest];
            		$houses[$highest] = $hold;
            	}
            }
            foreach ($houses as $ind => $shop) {
       		if ($shop && count($shop->ratings) > 0) {
            		$avg = 0;
            		foreach ($shop->ratings as $rating) {
            			$avg += $rating->rating;
       			}
       			$avg = $avg / count($shop->ratings);
            		$houses[$ind]->rated = $avg;
            	} else {
            		$houses[$ind]->rated = 0;
       		}
            }
            for ($i = 0; $i < count($houses); $i++) {
            	$highest = $i;
            	for ($j = $i + 1; $j < count($houses); $j++) {
            		if ($houses[$j]->rated > $houses[$i]->rated) {
            			$highest = $j;
            		}
            	}
            	if ($houses[$i]->rated < $houses[$highest]->rated) {
            		$hold = $houses[$highest];
            		$houses[$highest] = $houses[$i];
            		$houses[$i] = $hold;
            	}
            }
		
	    $stores = json_encode($stores);
	    $stores = json_decode($stores);
	    $stores->data = $houses;
	    
            return $stores;
        }
    }

    public function getStoreWithFollowers (Request $request) {
        return Store::with("followers")->find($request->id);
    }

    public function incrementStoreVisits (Request $request) {
        $store = Store::find($request->store_id);

        $store->views = $store->views + 1;
        $store->save();

        return Controller::responder(true, "Store visits updated successfully.", $store);
    }

    /**
     * Get all stores that have videos.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getStoreVideos (Request $request) {
        $stores = Store::all();
        $stores_with_videos = $stores->unique("videos");
        return Controller::responder(true, "Success", $stores_with_videos);
    }
    
    /**
     * Get all stores that have stories.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getStoreStories (Request $request) {
        $stores = Store::all()->sortByDesc("story.created_at");
        return Controller::responder(true, "Success", $stores);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @Request({
     *     summary: Get Product endpoint - GET request query parameters: {all=1},
     *     description: Get product endpoint - Parameters for POST request: {category_id, store_id},
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: Store
     * )
     * @param  \App\Http\Requests\StoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreRequest $request)
    {
        $store = Store::where("user_id", $request->user_id)->get()->unique();
        if (count($store) > 1) {
            return Controller::responder(false, "User already has a store.", $store);
        }
        $request->validate([
            "name" => ["required", "string", "unique:stores,name"],
            "address" => ["required", "string"],
            "phone" => ["required", "string"],
            "user_id" => ["required", "exists:users,id"],
            "category_id" => ["required", "exists:categories,id"]
        ]);

        $store = Store::create([
            "name" => $request->name,
            "address" => $request->address,
            "email" => $request->email,
            "phone" => $request->phone,
            "user_id" => $request->user_id,
            "position" => $request->position,
            "logo" => $request->logo,
            "primary_media" => $request->primary_media,
            "category_id" => $request->category_id,
            "product_category_id" => $request->product_category_id,
            "background_image" => $request->bgimg,
            "sound" => $request->audio,
            "description" => $request->description,
            "animation" => $request->animation,
            "state_id" => $request->state_id
        ]);

        $user = User::find($request->user_id);

        //Set usertype to Vendor/Store owner
        $user->usertype_id = 3;

        $user->save();

        $store->hash = str_replace("/", "", Hash::make($store->id));
        $store->save();
        
        //Create default subscription for store
        $subs = Subscription::create([
        		"store_id" => $store->id,
        		"tx_ref" => "Initial-".Str::random(12),
            		"transaction_id" => "Initial-".Str::random(15),
            		"status" => "Successful",
            		"price" => 0,
            		"plan_id" => 1
        	]);

        $store = Store::find($store->id);
        
        return Controller::responder(true, "Your store has been successfully created.", $store);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @Request({
     *     summary: Get Product endpoint - GET request query parameters: {all=1},
     *     description: Get product endpoint - Parameters for POST request: {category_id, store_id},
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: Store
     * )
     * @param  \App\Http\Requests\UpdateStoreRequest  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $request->validate([
            "name" => ["required", "string"],
            "address" => ["required", "string"],
            "phone" => ["required", "string"],
            "email" => ["required", "string"]
        ]);

        $store = Store::find($request->store_id);
        $store->name = $request->name;
        $store->address = $request->address;
        $store->email = $request->email;
        $store->phone = $request->phone;
        $store->description = $request->description;
        $store->animation = $request->animation;
//        $store->category_id = $store->category_id;
//        $store->product_category_id = $store->product_category_id;
        $store->background_image = $request->bgimg;
        $store->sound = $request->sound;
        $store->volume = $request->volume;
        if ($request->state_id) $store->state_id = $request->state_id;
        if ($request->logo) $store->logo = $request->logo;
        if ($request->primary_media) $store->primary_media = $request->primary_media;

        $store->save();

        return Controller::responder(true, "Your store settings has been successfully updated.", $store);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}
