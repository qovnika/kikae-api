<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductcommentsRequest;
use App\Http\Requests\UpdateProductcommentsRequest;
use App\Models\Productcomments;
use Illuminate\Http\Request;

class ProductcommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id) {
            $comments = Productcomments::orderBy("id", "DESC")->where("product_id", $request->id)->get()->unique();
        } else {
            $comments = Productcomments::all()->sortByDesc("id");
        }

        return Controller::responder(true, "Successfully retrieved comments.", $comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @Request({
     *     summary: Store Product comments endpoint - GET request query parameters: {all=1},
     *     description: Store product comments endpoint - Parameters for POST request requires comment, product_id and parent_id: {comment, product_id, parent_id},
     *     tags: Product
     * })
     * @Response(
     *    code: 200
     *    ref: ProductComments
     * )
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
     * @param  \App\Http\Requests\StoreProductcommentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductcommentsRequest $request)
    {
        $request->validate([
            "user_id" => "required",
            "comment" => "required",
            "product_id" => "required"
        ]);

        if (!$request->parent) {
            $parent = 0;
        } else {
            $parent = $request->parent;
        }

        $comment = Productcomments::create([
            "user_id" => $request->user_id,
            "comment" => $request->comment,
            "product_id" => $request->product_id,
            "parent_id" => $parent
        ]);

        return Controller::responder(true, "Comment made successfully.", $comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productcomments  $productcomments
     * @return \Illuminate\Http\Response
     */
    public function show(Productcomments $productcomments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productcomments  $productcomments
     * @return \Illuminate\Http\Response
     */
    public function edit(Productcomments $productcomments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductcommentsRequest  $request
     * @param  \App\Models\Productcomments  $productcomments
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductcommentsRequest $request, Productcomments $productcomments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productcomments  $productcomments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productcomments $productcomments)
    {
        //
    }
}
