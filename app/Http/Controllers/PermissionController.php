<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controller;





class PermissionController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('permission:edit permission',['only'=>['update','edit']]);
        $this->middleware('permission:create permission',['only'=>['create','store']]);
        $this->middleware('permission:delete permission',['only'=>['destroy']]);
        
        
    }
   
    public function index()
    {
        $permission = Permission::get();
        return view('role-permission.permission.one', compact('permission'));
    }
    public function create()
    {

        return view('role-permission.permission.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'

            ]

        ]);
        Permission::create([
            'name' => $request->name
        ]);
        return redirect('permissions')->with('status', 'permission created successfully');
    }



    public function edit($id)
    {
        $permission = Permission::find($id);
        
        return view('role-permission.permission.edit',compact('permission'));
    }
    public function update( Request $request ,$id) {
        $permission = Permission::find($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$id

            ]

        ]); 
        $permission->name =$request->name;
        $permission->save();
        return redirect('permissions')->with('status', 'permission updated successfully');;

    }
    public function destroy($id) {
        $find=Permission::find($id);
        $find->delete();
        return redirect('permissions')->with('status-delete','permission deleted');
    }
}
