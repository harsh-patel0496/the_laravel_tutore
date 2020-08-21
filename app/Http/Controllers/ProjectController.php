<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Facades\ResponseJsonFacade;
use App\Http\Resources\UserCollection;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $project;

    public function __construct(Project $project){
        $this->project = $project;
    }

    public function index()
    {
        $projects = $this->project->withCount('users')->withCount('tasks')->get();
        if(!empty($projects)){
            $result = ResponseJsonFacade::result(true,'','projects',$projects);
            return response()->json($result);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newProject = $this->project->create($request->all());
        if(!empty($newProject)){
            $result = ResponseJsonFacade::result(true,'Task created successfuly!','projects',$newProject);
            $status = 200;
        } else {
            $result = ResponseJsonFacade::result(false,'Something went wrong!');
            $status = 500;
        }
        return response()->json($result,$status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$pivot)
    {   
        $project = $this->project->where('id',$id)->with([ $pivot => function ($query) use($pivot) {
            if($pivot == 'tasks'){
                $query->orderBy($pivot.'.priority', 'desc');
            } else {
                $query->orderBy($pivot.'.id', 'desc');
            }
            
        }])->first();
        if($pivot == 'tasks'){
            $finalArray = [];
            foreach($project->tasks as $task){
                $finalArray[$task->type][] = $task;
            }
            $status = 200;
            $result = ResponseJsonFacade::result(true,'','tasks',$finalArray);
        } else {
            if(!empty($project)){
                $status = 200;
                $result = ResponseJsonFacade::result(true,'','project',$project);
            } else {
                $status = 500;
                $result = ResponseJsonFacade::result(false,'Something went wrong!');
            }
        }

        return response()->json($result,$status);
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
}
