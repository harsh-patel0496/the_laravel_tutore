<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Facades\ResponseJsonFacade;
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
        $createdTask->projects()->attach([$task['project']]);
        $createdTask->users()->attach($this->user);
        $taskWithProjects = $this->taskWithProjects($task['project']);
        $result = ResponseJsonFacade::result(true,'Task Created Successfully!','tasks',$taskWithProjects);
        
        return response()->json($result);

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
            
            foreach($data['newPriority'] as $key => $val){
                $this->task->where('id',$key)->update(['priority' => $val]);
            }
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

    protected function taskWithProjects($project_id){
        $taskWithUser = $this->task->select('tasks.id','tasks.name','tasks.type')->with('projects')->whereHas('projects' , function($query) use ($project_id){
            $query->where('projects.id',$project_id);
        })->orderBy('tasks.priority', 'desc')->get();

        $finalArray = [];
        foreach($taskWithUser as $task){
            $finalArray[$task->type][] = $task;
        }
        return $finalArray;
    }
}
