<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(UserLoginRequest $request)
    {
        $user = User::where("email", $request->email)->first();
        if ($user) {
        } else {
            return response()->jsom(
                [
                    "success" => false,
                    "message" => "Invalid email or password",
                ],
                400
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRequest $request)
    {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->name),
        ]);

        return new UserResource($user);
    }
}
