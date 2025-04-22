<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Manager;
use App\Models\Regulization;
use App\Models\Section;
use App\Models\UserLeave;
use App\Models\Workfromhome;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class LeaveController extends Controller
{

    public function __construct()
    {


        $this->middleware('permission:add leave type', ['only' => ['add_leaveType', 'store_leave_type',]]);
    }
    public function index($id)
    {

        $data = Manager::where('user_id', $id)->first();
        $leave_count = UserLeave::where('user_id', $data->user_id)->first();
        $leave_types = LeaveType::where('type', 'LEAVE')->get();
        $sessions = Section::all();


        return view('leave.leave-request', compact('data', 'leave_count', 'leave_types', 'sessions'));
    }


    public function store(Request $request)
    {


        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'leave_type_id' => 'required',
        //     'from_date' => 'required|date',
        //     'to_date' => 'required|date',
        //     'section_id' => 'required',
        //     'reason' => 'required|string',
        //     'remarks' => 'nullable|string',
        // ]);

        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date);




        if ($fromDate == $toDate) {

            if ($request->session == 2) {

                $totalDays = 0.5;
            } else {
                $totalDays = 1.0;
            }
        } else {
            $totalDays = $fromDate->diffInDays($toDate) + 1;
        }




        Leave::create([
            'user_id' => $request->user_id,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'section_id' => $request->session,
            'total' => $totalDays,
            'reason' => $request->reason,
            'remarks' => $request->remarks,
            'leave_type_id' => $request->leave_type,

        ]);
        return redirect()->route('show-request', ['id' => $request->user_id]);
    }
    public function show($id)
    {

        $data = Leave::with('LeaveType')->with('Status')->with('Section')->where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $data2 = Workfromhome::with('LeaveType')->with('Status')->with('Section')->where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $data3 = Regulization::where('user_id', $id)->orderBy('created_at', 'desc')->get();


        return view('leave.view-request', compact('data', 'data2', 'data3'));
    }

    public function add_leaveType()
    {

        return view('leave.add_leave_type');
    }

    public function store_leave_type()
    {
        LeaveType::create([
            'type_name' => request()->leave_type
        ]);
        return redirect('/add-leaveType');
    }
}
