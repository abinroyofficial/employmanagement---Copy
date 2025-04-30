<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Gender;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controller;


class ManagerController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:update user biodata', ['only' => ['updateinfo', 'store']]);
        $this->middleware('permission:team list', ['only' => ['myteam']]);
    }




    public function viewprofile($id)
    {
        $data = Manager::where('user_id', $id)->first();
        $user = User::where('id', $id)->first();

        $supervisor = Manager::where('user_id', $id)->first()->supervisor;
        $sup_name = User::where('id', $supervisor)->first()->name;



        return view('manager.view-profile', compact('data', 'user', 'sup_name'));
    }


    public function updateinfo($id)
    {
        // to get role wise category list
        $managers = User::role('manager')->pluck('name', 'id');
        $seniormanagers = User::role('senior manager')->pluck('name', 'id');
        $superadmins = User::role('super admin')->pluck('name', 'id');
        $departments = Department::all();
        $genders = Gender::all();


        $user = User::where('id', $id)->first();
        return view('manager.update-profile', compact('user', 'managers', 'seniormanagers', 'superadmins', 'departments', 'genders'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('photo')) {
            $extension = request('photo')->extension();
            $filename = 'user_name' . time() . '.' . $extension;
            $request->file('photo')->storeAs('public/images', $filename);


            Manager::create([
                'user_id' => $request->user_id,
                'employ_id' => $request->employ_id,
                'phone' => $request->phone,
                'department_id' => $request->department,
                'gender_id' => $request->gender,
                'supervisor' => $request->supervisor,
                'work_time_from' => $request->work_time_from,
                'work_time_to' => $request->work_time_to,
                'salary' => $request->salary,
                'leave' => $request->leave,
                'photo' => $filename,

            ]);
        }
        return redirect('users')->with('status', 'user info  updated successfully');
    }

    public function myteam($id)

    {

        $team_members = Manager::where('supervisor', $id)->get();
        foreach ($team_members as $member) {
            $user = User::find($member->user_id);
            $member->user_name = $user->name;
            $member->user_email = $user->email;
        }


        return view('manager.viewTeam', compact('team_members'));
    }
}
