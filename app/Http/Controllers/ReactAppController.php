<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReactAppController extends Controller
{
    //

    public function __construct(){
        $this->middleware("auth:react",['except' => ['authenticate','signup']]);
    }

    public function authenticate(Request $request){

        
        $credentials = request(["email","password"]);

        if(auth()->attempt($credentials)){
            $user = auth()->user();
            $token = $user->createToken($user->email.'-'.now());
            return response()->json([
                'token' => $token->accessToken,
                'user' => $user
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
