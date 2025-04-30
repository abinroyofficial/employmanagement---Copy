<?php

namespace App\Http\Controllers;

use App\Jobs\NewUserJob;
use App\Mail\UserRegisterMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controller;



class UserController extends Controller
{

    public function __construct()
    {

        $this->middleware('permission:edit user', ['only' => ['update', 'edit']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
        $this->middleware('permission:view user', ['only' => ['index']]);
    }

    public function index()
    {
        $users = User::get();

        return view('role-permission.users.one', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('role-permission.users.create', compact('roles'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|string',
            'roles' => 'required'
        ]);
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,

        ]);


        $users->syncRoles($request->roles);
        $roles = User::where('email', $request->email)->first()->getRoleNames()->implode(', ');

        // email using queue and jobs 
        NewUserJob::dispatch($name, $email, $password,$roles);

        //Mail::to($users->email)->cc('abinroy4321@gmail.com')->send(new UserRegisterMail($name,$email,$password,$roles));
        return redirect('users')->with('status', 'user added successfully');
    }

    public function edit($id)
    {
        $roles = Role::pluck('name')->all();
        $users = User::find($id);
        $user_roles = $users->roles->pluck('name');

        return view('role-permission.users.edit', compact('roles', 'users', 'user_roles'));
    }

    public function update(Request $request, $id)
    {
        $users = User::find($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'roles' => 'required'
        ]);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->syncRoles($request->roles);
        $users->save();
        return redirect('users')->with('status', 'user updated successfully');
    }


    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect('users')->with('status-delete', 'user deleted successfully');
    }
}
