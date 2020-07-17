<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\RoleRequest;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::with('permission')->has('permission')->get()->toArray();
        return response()->json($roles,200);
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
        $validator = Validator::make($request->all(), [
            //
            "name" => 'required|string',
            "description" => 'required|string',
            "permissions" => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        try{
            $role = $request->all();
            $permissions = $role['permissions'];
            $newRole = Role::create([
                'name' => $role['name'],
                'description' => $role['description']
            ]);
            
            $dataToSave = array();
            foreach($permissions as $key => $permission){
                $dataToSave[$key]['role_id'] = $newRole->id;
                $dataToSave[$key]['created_at'] = date('Y-m-d H:i:s');
                $dataToSave[$key]['updated_at'] = date('Y-m-d H:i:s');
                foreach($permission as $k => $val){
                    if($k == 'module'){
                        $dataToSave[$key][$k] = $val;
                    } else {
                        $dataToSave[$key][$k] = json_encode($val);
                    }
                }
            }
    
            if(!empty($dataToSave)){
                $newPermission = array();
                $newPermission = Permission::insert($dataToSave);
            }
            
            $result = array(
                'role' => Role::where('id',$newRole->id)->with('permission')->first(),
                'status' => true,
                'message' => 'Role successfully added!'
            );

            return response()->json($result,200);
        } catch(Exception $e){
            $result = array(
                'status' => false,
                'message' => $e->getMessage()
            );

            return response()->json($result,500);
        }
       
        
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
