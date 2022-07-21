<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }
    
    public function index(){
        return $roles=Role::all();
        
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:roles'
        ]);
        $role = new Role();        
        $role->name = $request->name;
        $role->save();
        
    }
    public function edit($id){
        return $role=Role::findOrfail($id);        
        
    }
    public function update(Role $role,Request $request){
        $request->validate([
            'name' => 'required|unique:roles'
        ]);
        $role->name=$request->name;
        $role->save();        
    }
    public function destroy(Role $role){        
        $role->delete();        
    }
}

