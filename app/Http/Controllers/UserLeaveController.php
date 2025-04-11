<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLeave;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserLeaveController extends Controller
{
    public function index($id)
    {

        $user = User::where('id', $id)->first();
        return view('userLeave.add-leave-data', compact('user',));
    }
    public function store(Request $request)
    {
        $user_id = $request->user_id;
        $year = Carbon::today()->year;
        $casual_leave = $request->casualLeave;
        $sick_leave = $request->sickLeave;
        $earned_leave = $request->earnedLeave;


        UserLeave::create([
            'user_id' => $user_id,
            'year' => $year,
            'casual_leave' => $casual_leave,
            'sick_leave' => $sick_leave,
            'earned_leave' => $earned_leave,

        ]);
        return redirect('users');
    }

    public function show($id)
    {
        $leave_count = UserLeave::where('user_id', $id)->get();
        $user = User::where('id', $id)->first();
        return view('userLeave.view', compact('leave_count','user'));
    }
}
