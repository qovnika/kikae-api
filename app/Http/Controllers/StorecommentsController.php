<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStorecommentsRequest;
use App\Http\Requests\UpdateStorecommentsRequest;
use App\Models\Storecomments;
use Illuminate\Http\Request;

class StorecommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id) {
            $comments = Storecomments::orderBy("id", "DESC")->where("store_id", $request->id)->get()->unique();
        } else {
            $comments = Storecomments::all()->sortByDesc("id");
        }

        return Controller::responder(true, "Successfully retrieved comments.", $comments);
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
     *     summary: Get Product endpoint - GET request query parameters,
     *     description: Get product endpoint - Parameters for POST request: {store_id, comment, user_id, parent_id},
     *     tags: Store
     * })
     * @Response(
     *    code: 200
     *    ref: Storecomments
     * )
     * @param  \App\Http\Requests\StoreStorecommentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStorecommentsRequest $request)
    {
        $request->validate([
            "user_id" => "required",
            "comment" => "required",
            "store_id" => "required"
        ]);

        if (!$request->parent) {
            $parent = 0;
        } else {
            $parent = $request->parent;
        }

        $comment = Storecomments::create([
            "user_id" => $request->user_id,
            "comment" => $request->comment,
            "store_id" => $request->store_id,
            "parent_id" => $parent
        ]);

        return Controller::responder(true, "Comment made successfully.", $comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Storecomments  $storecomments
     * @return \Illuminate\Http\Response
     */
    public function show(Storecomments $storecomments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Storecomments  $storecomments
     * @return \Illuminate\Http\Response
     */
    public function edit(Storecomments $storecomments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStorecommentsRequest  $request
     * @param  \App\Models\Storecomments  $storecomments
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStorecommentsRequest $request, Storecomments $storecomments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Storecomments  $storecomments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Storecomments $storecomments)
    {
        //
    }
}
