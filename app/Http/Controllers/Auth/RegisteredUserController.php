<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'fname' => $request->fname,
            'onames' => $request->onames,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            'profilePic' => $request->profilePic,
            'usertype_id' => 1,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

//        Auth::login($user);

        return response([
            "message" => "Your account has been created successfully.",
            "user" => $user
        ]);
    }

    public function getUser (Request $request): Response
    {
        $request->validate([
            'email' => ['required', 'string', 'email']
        ]);

        $user = User::where(["email" => $request->email])->first();

        return response([
            "fullName" => $user->name,
            "email" => $user->email
        ]);
    }

    public function currentUser (Request $request) {
        return Auth::user();
    }

}
