<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @Request({
     *     summary: Get the currently logged in user,
     *     description: Get the currently logged in user - The user must be logged in or an error would be received. Pass a user's id to get the user,
     *     tags: User
     * })
     */
    public function index(Request $request)
    {
        if ($request->id) {
            return User::find($request->id);
        } else {
            $users = User::orderBy("id", "DESC")->get();
            return Controller::responder(true, "Successfully retrieved system users.", $users);
        }
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
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
        ]);

        $user = User::find($request->id);
        $user->fname = $request->fname;
        $user->onames = $request->onames;
        $user->lname = $request->lname;
        if ($request->email) $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->status) $user->status = $request->status;
        if ($request->address) $user->address = $request->address;
        if ($request->dob) $user->dob = $request->dob;
        if ($request->profilePic) $user->profilePic = $request->profilePic;
        if ($request->usertype_id) $user->usertype_id = $request->usertype_id;
        if ($request->deactivate) $user->tokens()->delete();

        $user->save();

        return Controller::responder(true, "The user has been updated successfully.", $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /* @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function uploadFile(Request $request)
    {
        $image_extensions = ["jpg", "jpeg", "png", "gif", "svg", 'webp'];
        $audio_extensions = ["mp3", "ogg", "wav"];
        $video_extensions = ["mp4", "webm", "ogg"];
        $file = $request->file('file');
        if (in_array($file->getClientOriginalExtension(), $image_extensions)) {
            $path = $file->store('profile-pic');
        } elseif (in_array($file->getClientOriginalExtension(), $audio_extensions)) {
            $path = $file->store("audios");
        } elseif (in_array($file->getClientOriginalExtension(), $video_extensions)) {
            $path = $file->store("videos");
        }
        return Controller::responder(true, "The file has been uploaded successfully. ".$file->getClientOriginalExtension(), $path);
    }

    /* @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function uploadMessageFile(Request $request)
    {
        $image_extensions = ["jpg", "jpeg", "png", "gif", "svg", "webp"];
        $audio_extensions = ["mp3", "ogg"];
        $video_extensions = ["mp4", "webm", "ogg"];
        $file = $request->file('file');
        $path = $file->store('message-files');
        
        return Controller::responder(true, "The file has been uploaded successfully.", $path);
    }

    public function getRandom () {
        $n = 20;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
     
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
     
        return $randomString;
    }
}
