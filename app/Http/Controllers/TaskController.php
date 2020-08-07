<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{

    protected $task;
    protected $user;
    public function __construct(Task $task){
        $this->task = $task;
        $this->user = auth('react')->user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $taskWithUser = $this->taskWithUsers();
        $result = array(
            'status' => true,
            'tasks' => $taskWithUser,
        );

        return response()->json($result);
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
        $task = $request->all();
        $createdTask = $this->task->create($task);
        $createdTask->users()->attach($this->user);
        $taskWithUser = $this->taskWithUsers();
        $result = array(
            'status' => true,
            'tasks' => $taskWithUser,
            'message' => 'Task Created Successfully!'
        );

        return response()->json($taskWithUser);

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
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        $task = $this->task->where('id',$id)->update(['type' => $data['destinationType']]);
        if($task == 1){
            $result = array(
                'status' => true,
                'message' => 'Type Updated Successfuly!'
            );
        } else {
            $result = array(
                'status' => false,
                'message' => 'Something went wrong!'
            );
        }
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function taskWithUsers(){
        $taskWithUser = $this->task->select('tasks.id','tasks.name','tasks.type')->with('users')->whereHas('users' , function($query){
            $query->where('users.id',$this->user->id);
        })->get();

        $finalArray = [];
        foreach($taskWithUser as $task){
            $finalArray[$task->type][] = $task;
        }
        return $finalArray;
    }
}
