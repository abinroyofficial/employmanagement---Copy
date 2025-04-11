<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('permission:edit role',['only'=>['update','edit']]);
        $this->middleware('permission:create role',['only'=>['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:delete role',['only'=>['destroy']]);
        $this->middleware('permission:view role',['only'=>['index']]);
       
        
    }

    public function index()
    {
        $roles = Role::get();
        return view('role-permission.roles.one', compact('roles'));
    }
    public function create()
    {

        return view('role-permission.roles.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'

            ]

        ]);
        Role::create([
            'name' => $request->name
        ]);
        return redirect('roles')->with('status', 'roles created successfully');
    }



    public function edit($id)
    {
        $roles = Role::find($id);

        return view('role-permission.roles.edit', compact('roles'));
    }
    public function update(Request $request, $id)
    {
        $roles = Role::find($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $id

            ]

        ]);
        $roles->name = $request->name;
        $roles->save();
        return redirect('roles')->with('status', 'roles updated successfully');;
    }
    public function destroy($id)
    {
        $find = Role::find($id);
        $find->delete();
        return redirect('roles')->with('status-delete', 'roles deleted');
    }

    public function addPermissionToRole($id)
    {
        $permissions = Permission::all();
        $role = Role::find($id);
        $permission_id = DB::table('role_has_permissions')->where('role_id','=',$id)->pluck('permission_id')->toArray();
        return view('role-permission.roles.add-permission', compact('role', 'permissions','permission_id'));
    }

    public function givePermissionToRole(Request $request, $id)
    {
        
        $request->validate([
            'permission' => [
                'required'
            ]

        ]);
        $role = Role::find($id);
        $role->syncPermissions($request->permission);
        return redirect('roles')->with('status', 'permission added to role');

    }
}
