<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordForgotten;

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
        $characters = "0123456789";
        $randomString = '';
     
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
     
        return $randomString;
    }

    /**
     * Update the user's password.
     *
     * @return \Illuminate\Http\Response
     * @Request({
     *     summary: Update the user's password - old password and new must be provided,
     *     description: Update the user's password - User's ID, old password and new password must be provided as id, password, confirmed respectively,
     *     tags: User
     * })
     */
    public function updatePassword (Request $request) {
		$request->validate([
		    'id' => ['required'],
		    'password' => ['required', 'confirmed', Rules\Password::defaults()],
		]);

		$user = User::find($request->id);
		if (!Hash::check($request->old, $user->password)) {
			return Controller::responder(false, "The old password you entered does not match what we have in our database. Please try again.");
		} else {
			$user->password = Hash::make($request->password);
			$user->save();
			
			return Controller::responder(true, "Your password has been changed successfully.", $user);
		}
	}
	
    /**
     * Generate and send a new password for the user.
     *
     * @return \Illuminate\Http\Response
     * @Request({
     *     summary: Generate and send a new password for the user,
     *     description: Generate and send a new password for the user - This saves the password in the database for the user,
     *     tags: User
     * })
     */
	public function forgotPassword (Request $request) {
		$user = User::where("email", $request->email)->first();
		if ($user) {
			$password = $this->generateRandomString(12);
			$user->password = Hash::make($password);
			$user->save();
			Mail::to($user->email)->send(new PasswordForgotten($user, $password));
			return Controller::responder(true, "Successfully sent password to your email address.", $user);
		} else {
			return Controller::responder(false, "The email address you provided is not in our records. Please make sure you entered the correct email address.", $user);
		}
		
	}

    /**
     * Send code to the user's email.
     *
     * @return \Illuminate\Http\Response
     * @Request({
     *     summary: Send code to the user's email,
     *     description: Send code to the user's email to allow the user change their password,
     *     tags: User
     * })
     */
	public function sendCode (Request $request) {
		$user = User::where("email", $request->email)->first();
		if ($user) {
			$passcode = $this->generateRandomString(6);
			$user->code = $passcode;
			$user->save();
			Mail::to($user->email)->send(new PasswordForgotten($user, $passcode));
			return Controller::responder(true, "Successfully sent code to your email address.", $user);
		} else {
			return Controller::responder(false, "The email address you provided is not in our records. Please make sure you entered the correct email address.", $user);
		}
		
	}

    /**
     * Verify the code the user entered.
     *
     * @return \Illuminate\Http\Response
     * @Request({
     *     summary: Verify the code the user entered,
     *     description: Verify the code the user entered - This endpoint requires the email address and the code as email, code respectively,
     *     tags: User
     * })
     */
    public function verifyCode (Request $request) {
		$request->validate([
		    'email' => ['required'],
		    'code' => ['required'],
		]);

		$user = User::where("email", $request->email)->first();
        if ($user) {
            if ($user->code == $request->code) {
                return Controller::responder(true, "Code is correct.", $user);
            } else {
                return Controller::responder(false, "Code is incorrect. Please try again.", $user);
            }
        }        
    }

    function generateRandomString($length = 10) {
	    return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
	}
	
}
