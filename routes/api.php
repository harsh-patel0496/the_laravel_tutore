<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([

    'middleware' => ['api','ApiGuard:api']

], function ($router) {
    Route::post('/user/login','UsersController@login');
    Route::post('/user/signup','UsersController@signup');
    Route::post('/user/save','USersController@save')->middleware('IpCheck');
    Route::post('/reactUser/login','ReactAppController@authenticate');
    Route::get('/passport',function(){
        $state = Str::random(40);
        $query = http_build_query([
            'client_id' => '6',
            'redirect_uri' => 'http://127.0.0.1:8080/api/callBack',
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
        ]);
        return redirect('http://localhost:8000/oauth/authorize?'  .$query);
    })->name('passport');
    
    Route::get('/callBack', function (Request $request) {
        //$request = request();
        $code = $request->all()['code'];
        //$state = $request->session()->pull('state');
        // throw_unless(
        //     strlen($state) > 0 && $state === $request->state,
        //     InvalidArgumentException::class
        // );
    
        $http = new GuzzleHttp\Client;
            //dump($code);
        $response = $http->post('http://localhost:8000/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => 6,
                'client_secret' => '5u2X0PwHtQY3tTnvGsCWb2qtKOGkveUtzTL7HO1p',
                'redirect_uri' => 'http://127.0.0.1:8080/api/callBack',
                'code' => $code,
            ],
        ]);
    
        return json_decode((string) $response->getBody(), true);
    });

    Route::group(['prefix' => 'role','middleware' => ['auth:react']], function () {
        Route::get('/','RoleController@index');
        Route::post('/store','RoleController@store');
    });

    Route::group(['prefix' => 'message','middleware' => ['auth:react']],function(){

        Route::get('/getMessages/{user_id}/{friend_id}','MessageController@index');
        Route::post('/store','MessageController@store');
        Route::get('/getFriends/{user_id}','MessageController@getFriends');
        Route::post('/markAsRead','MessageController@markAsRead');
    });

});

