<?php

namespace App\Http\Controllers;

use App\Http\Requests\messageMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @Request({
     *     summary: Get messages endpoint - POST request query parameters:,
     *     description: Get Messages endpoint - Parameters for POST request must have the recepient id or sender id or both. The sender id/recepient id are constrained to the user table { sender_id ||/&& recepient_id }. The id of the message could also be passed to get the message,
     *     tags: Messages
     * })
     * @Response(
     *    code: 200
     *    ref: Message
     * )
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->recepient) {
            //Get all messages for the user logged currently in
            $messages = Message::orderBy("id", "DESC")->where("recepient_id", $request->recepient)->get()->unique("sender_id");
            $collection = [];
            foreach ($messages as $message) {
                $collection[] = $message;
            }
            return Controller::responder(true, "Messages returned successfully", $collection);
        } elseif ($request->sender_id && $request->recepient_id) {
            $messages = Message::orderBy("id", "DESC")->where("sender_id", $request->sender_id)
                        ->where("recepient_id", $request->recepient_id)
                        ->orWhere(function (Builder $query) use ($request) {
                            $query->where("sender_id", $request->recepient_id)
                                ->where("recepient_id", $request->sender_id);
                        })->get();
            return Controller::responder(true, "Messages returned successfully", $messages);
        } elseif ($request->id) {
            $message = Message::find($request->id);
            if ($message) {
                $message->read = true;
                $message->save();
            }
            return Controller::responder(true, "Message returned successfully", $message);
        } else {
            $messages = Message::all();
            return $messages;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $request->validate([
            "recepient_id" => ["required"],
            "sender_id" => ["required"],
            "body" => ["required", "string"]
        ]);

        $message = Message::create([
            "recepient_id" => $request->recepient_id,
            "sender_id" => $request->sender_id,
            "body" => $request->body
        ]);

        return Controller::responder(true, "Your message has been sent successfully.", $message);
    }

    /**
     * Create a new resource, i.e the message.
     *
     * @Request({
     *     summary: Create messages endpoint - POST request query parameters:,
     *     description: Create Messages endpoint - Parameters for POST request must have the recepient id, sender id and body. The sender id/recepient id are constrained to the user table { sender_id && recepient_id && body },
     *     tags: Messages
     * })
     * @Response(
     *    code: 200
     *    ref: Message
     * )
     * 
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        $request->validate([
            "recepient_id" => ["required"],
            "sender_id" => ["required"],
            "body" => ["required", "string"]
        ]);

        $message = Message::create([
            "recepient_id" => $request->recepient_id,
            "sender_id" => $request->sender_id,
            "body" => $request->body,
            "type" => $request->type
        ]);

        return Controller::responder(true, "Your message has been sent successfully.", $message);
    }

    /**
     * message a newly created resource in storage.
     *
     * @param  \App\Http\Requests\messageMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function message(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @Request({
     *     summary: Update messages endpoint - POST request query parameters:,
     *     description: Update Messages endpoint - Parameters for POST request must have the recepient id, sender id and body. The sender id/recepient id are constrained to the user table { sender_id && recepient_id && body },
     *     tags: Messages
     * })
     * @Response(
     *    code: 200
     *    ref: Message
     * )
     * 
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        $message = Message::find($request->id);
        $message->read = $request->read;
        $message->starred = $request->starred;
        $message->archived = $request->archived;
        $message->muted = $request->muted;

        $message->save();

        return Controller::responder(true, "The message has been successfully updated.", $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Request({
     *     summary: Delete messages endpoint - POST request query parameters:,
     *     description: Delete Messages endpoint - Parameters for POST request must have the message id { id },
     *     tags: Messages
     * })
     * @Response(
     *    code: 200
     *    ref: Message
     * )
     * 
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $mess = Message::find($request->id);
        $old = $mess;
        $mess->delete();

        return Controller::responder(true, "Successfully deleted message.", $old);
    }
}
