<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //

	public function __construct(){
        
		$this->middleware('auth:api', ['except' => ['login','signup']]);
	}

    public function index(){
    	echo "Here The Index";
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if ($token = auth()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
        
    }

    

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        //return auth()->user();
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $this->me()
        ]);
    }

    public function signup(Request $request){
    	try{
    		User::create([
	    		'name' => request('name'),
	    		'email' => request('email'),
	    		'password' => Hash::make(request('password'))
	    	]);
    		return $this->login(request());
    	} catch(Exception $e){
    		return $e->getMessage();
    	}
    	
    }

    public function save(Request $request){
        $name = $request->file("image");
        Storage::putFileAs('avtars',$name,'test1.png');
        Storage::download('/avtars/test1.png');
        $category = Category::create([
            'name' => request('name'),
            'description' => request('description'),
            'type' => request('type')
        ]);
        return response(request()->all());

    }
}
