<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

class Stadium {

}

class Football{
    public function __construct(Stadium $stadium){
        $this->stadium = $stadium;
    } 
}

class Game {
    public function __construct(Football $football){
        $this->name = $football;
    }
}

// app()->bind('Game',function () {
//     return new Game();
// });

// app()->instance('Game',function(){
//     return "Game";
// });

//dump(resolve("Game")); //php reflaction class
//dd(app());
// dd(app());

//singleton() //instand of bind use only one time
use Illuminate\Support\Facades\Cache;
use App\Facades\FishFacade;
use App\Events\TaskEvent;
use Illuminate\Support\Facades\Log;

Cache::set('name',"Harsh");
//cache()->set('name',"Harsh");

//dd(Cache::get('name')); //cache()->get('name');

// class Fish {

//     public function swim(){
//         return 'Swimming';
//     }
    
//     public function eat(){
//         return 'Eating';
//     }
// }
// class FishFacade {
    
//     public static function __callStatic($name,$args){
//         return app()->make('fish')->$name();
//     }

// }

// dd(FishFacade::swim());

// $fish = app()->make('fish');
// dd($fish->swim());



Route::get('/passport',function(){
    request()->session()->put('state', $state = Str::random(40));
    $query = http_build_query([
        'client_id' => '6',
        'redirect_uri' => 'http://127.0.0.1:8080/callBack',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
    ]);

    return redirect('http://localhost:8000/oauth/authorize?'  .$query);
})->name('passport');

use Illuminate\Http\Request;
Route::get('/callBack', function (Request $request) {
    //$request = request();
    $code = $request->all()['code'];
    $state = $request->session()->pull('state');
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
            'redirect_uri' => 'http://127.0.0.1:8080/callBack',
            'code' => $code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});

Route::get('/', function (Request $request) {
    return view('welcome');
});

// Route::get('/resetPassword', function (Request $request) {
//     return view('mails.resetPassword');
// });

Route::get('/sendMail','SendMailController@sendMail')->name('sendMail');
Route::get('event',function() {
    $message = 'Hey How Are You';
    Log::info(["test"=>"Hello"]);
    event(new TaskEvent($message));
});

Route::get('/arrayEvent','ArrayController@index');

Route::get('/sendNotification','NotificationController@sendNotification')->name('notify');

// Route::get('pay','PayOrderController@store');
// Route::get('/user/index','UsersController@index');