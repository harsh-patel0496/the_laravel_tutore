<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Message;
use App\Events\TaskEvent;
use App\User;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $message;
    
    
    public function __construct(Message $message){
        //$this->middleware("auth:react");
        $this->message = $message;
    }
    
    public function index($user_id,$friend_id)
    {
        //
        $messages =$this->message->where([
            ['user_id','=',$user_id],
            ['to_user','=',$friend_id]
        ])
        ->orWhere([
            ['user_id','=',$friend_id],['to_user','=',$user_id]
        ])->get();

        $this->markAsRead($friend_id,$user_id);

        return response()->json($messages,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //return response()->json($request->all());
        $message = $this->message->create($request->all());
        if($message){
            $info = [
                "count" => 1,
                "sender" => $message['user_id']
            ];
            event(new TaskEvent($message,'App.User.'.($message['user_id'] * $message['to_user'])));
            event(new TaskEvent($info,$message['to_user']));
        }
        return response()->json($message,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$from_user,$to_user)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = $this->message->find($id);
        //dd($message);
        $user = auth('react')->user();
        //dd($user);

        /**
         * Check user is authorized to perform the delete aftion using Gates
         *
         * @param  \App\Message  $message
         * @return boolean
        */
        
        // if(Gate::forUser($user)->allows('delete-message',$message)){
        //     $deleted = $message->delete();
        //     dd($deleted);
        // }

        /**
         * Check user is authorized to perform the delete action using Policies
         *
         * @param  \App\Message  $message
         * @return boolean
        */

        if($user->can('delete',$message)){
            $deleted = $message->delete();
            if($deleted){
                $response = response()->json([
                    'status' => true,
                    'message' => 'Message deleted successfully!'
                ],200);
            } else {
                $response = response()->json([
                    'status' => false,
                    'message' => 'Oops!'
                ],500);
    
                return $response;
            }
           
        } else {
            $response = response()->json([
                'status' => false,
                'message' => 'You are not permitted to perform this action!'
            ],401);
    
            return $response;
        }
        
        //dd($user->can('delete',$user,$message));
    }

    public function getFriends($user_id){
        $user = User::find($user_id);
        $friends = $user->friends()->get();
        return response()->json($friends,200);
    }

    public function markAsRead($from_user,$to_user){

        $messages = tap($this->message->where(
            array(
                array('user_id','=',$from_user),
                array('to_user','=',$to_user)
            )
        ))->update(['readed' => 1])->get();
        
        if(count($messages) > 0){
            return true;
        }
        return false;
    }
}
