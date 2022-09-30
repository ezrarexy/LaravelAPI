<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $req)
    {
        $access = $req->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if ( auth()->attempt($access) ) {
            $user = auth()->user();

            return (new User($user))->additional([
                'token' => $user->createToken('AuthTest')->plainTextToken
            ]);
        }

        return response()->json(['message'=>'Invalid login info!'],401);
    }
}
