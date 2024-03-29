<?php

namespace App\Http\Controllers;
use App\Http\Controllers\UTILITY\DataUtilityController;
use App\Models\Role;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Role::query();
        
        
        $getData = new DataUtilityController($request,$query);
        $response = $getData->getData();
        $status = 200;

        return response($response,$status);             
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::where('rolename', $request->rolename)->first();     
        
        if($role){ 
            $response = [
                "message" => "Role name already exist"
            ];
            $status = 409;                
           
        }        
        else{
            $role = new Role;
            $role->customerId = $request->customerId;
            $role->rolename = $request->rolename;
            $role->rolecode = $request->rolecode;            
            $role->save();
            $response = [
                "message" => "Role added successfully"
            ];
            $status = 201;           
       }
       return response($response,$status);    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        if($role){
            $response = [
                "Role" => $role,
            ];
            $status = 200;           
        }
        else{
            $response = [
                "Role" => "Data not found",
            ];
            $status = 404;              
        }
        return response($response,$status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id){
       
        $role = Role::find($id);
        if($role){
            $role->customerId = $request->customerId;
            $role->rolename = $request->rolename;
            $role->rolecode = $request->rolecode;            
            $role->save();
            $response = [
                "message" => "Role updated successfully"
            ];
            $status = 200;            
        }
        else{
            $response = [
                "message" => "Data Not found"
            ];
            $status = 404;            
        }
        return response($response,$status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if($role){                 
            $role->delete();
            $response = [
                "message" => "Role deleted successfully"
            ];
            $status = 200;             
        }
        else{
            $response = [
                "message" => "Data not found"
            ];
            $status = 404;                   
        }
        return response($response,$status);

    }
}
