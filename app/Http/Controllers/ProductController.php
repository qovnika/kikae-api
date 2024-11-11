<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Media;
use App\Models\ProductColor;
use App\Models\ProductDrawing;
use App\Models\ProductFabric;
use App\Models\ProductLocation;
use App\Models\ProductSize;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @Request({
     *     summary: Get Product endpoint - GET request query parameters: {all=1},
     *     description: Get product endpoint - Parameters for POST request: {category_id, store_id},
     *     tags: Product
     * })
     * @Response(
     *    code: 200
     *    ref: Product
     * )
     */

    public function index(HttpRequest $request)
    {
        if ($request->id) {
            $products = Product::find($request->id);
            return Controller::responder(true, "Successfully retrieved products.", $products);
        } elseif ($request->store_id && $request->category) {
            $products = Product::orderBy("id", "DESC")->where([
                "store_id" => $request->store_id,
                "category_id" => $request->category
            ])->get();
            return Controller::responder(true, "Successfully retrieved products.", $products);
        } elseif($request->store_id) {
            $products = Product::orderBy("id", "DESC")->where('store_id', $request->store_id)->get();
            return Controller::responder(true, "Successfully retrieved products.", $products);
        } elseif ($request->category) {
            $products = Product::orderBy("id", "DESC")->where("category_id", $request->category)->get();
            return Controller::responder(true, "Successfully retrieved products.", $products);
        } elseif ($request->all) {
            $products = Product::all()->sortBy("id")->unique();
            return Controller::responder(true, "Successfully retrieved products.", $products);
        } else {
            $products = Product::orderBy("id", "DESC")->get();
            return Controller::responder(true, "Successfully retrieved products.", $products);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @Response(
     *    code: 200
     *    ref: Product
     * )
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @Request({
     *     summary: Store Product drawing endpoint - GET request query parameters,
     *     description: Store product drawing endpoint - Parameters for POST request requires product_id and size: {product_id, size},
     *     tags: Product
     * })
     * @Response(
     *    code: 200
     *    ref: Product
     * )
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $request->validate([
            "name" => ["required", "string"],
            "price" => ["required", "string"],
            "description" => ["required", "string"],
            "units" => ["required", "string"],
            "category_id" => ["required", "exists:categories,id"],
            "store_id" => ["required", "exists:stores,id"]            
        ]);

        $product = Product::create([
            "name" => $request->name,
            "price" => $request->price,
            "description" => $request->description,
            "units" => $request->units,
            "category_id" => $request->category_id,
            "product_category_id" => $request->product_category_id,
            "store_id" => $request->store_id,
            "old_price" => $request->old_price,
            "made_in_nigeria" => $request->made_in_nigeria
        ]);

	if (count($request->media) > 0) {
		$media = $request->media;
		foreach ($media as $medium) {
		    Media::create(array_merge($medium, ["product_id" => $product->id]));
		}
	}
	
	if (count($request->colours) > 0) {
		$colours = $request->colours;
		foreach ($colours as $colour) {
		    ProductColor::create(array_merge($colour, ["product_id" => $product->id]));
		}
	}
	
	if (count($request->fabrics) > 0) {
		$fabrics = $request->fabrics;
		foreach ($fabrics as $fabric) {
		    ProductFabric::create(array_merge($fabric, ["product_id" => $product->id]));
		}
	}

	if (count($request->drawings) > 0) {
		$drawings = $request->drawings;
		foreach ($drawings as $drawing) {
		    ProductDrawing::create(array_merge($drawing, ["product_id" => $product->id]));
		}
	}
	
	if (count($request->sizes) > 0) {
		$sizes = $request->sizes;
		foreach ($sizes as $size) {
		    ProductSize::create(array_merge($size, ["product_id" => $product->id]));
		}
	}
	
	if (count($request->addresses) > 0) {
		$addresses = $request->addresses;
		foreach ($addresses as $address) {
		    ProductLocation::create(array_merge($address, ["product_id" => $product->id]));
		}
	}
	
        $product = Product::find($product->id);

        return Controller::responder(true, "The Product has been successfully created.", $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     * @Response(
     *    code: 200
     *    ref: Product
     * )
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->validate([
            "name" => ["required", "string"],
            "price" => ["required"],
            "description" => ["required", "string"],
            "units" => ["required"],
            "category_id" => ["required", "exists:categories,id"],
            "store_id" => ["required", "exists:stores,id"]            
        ]);

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->units = $request->units;
        $product->category_id = $request->category_id;
        $product->product_category_id = $request->product_category_id;
        $product->store_id = $request->store_id;
        $product->old_price = $request->old_price;
        if ($request->made_in_nigeria) $product->made_in_nigeria = $request->made_in_nigeria;

        $product->save();

        return response([
            "message" => "The product has been updated successfully.",
            "product" => $product
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(HttpRequest $request)
    {
        $product = Product::find($request->id);
        $product->delete();

        return Controller::responder(true, "Successfully deleted the product - ".$product->name.".", $product);
    }
}
