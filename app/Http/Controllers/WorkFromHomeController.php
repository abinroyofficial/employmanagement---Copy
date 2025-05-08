<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use App\Models\Manager;
use App\Models\Section;
use App\Models\Workfromhome;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkFromHomeController extends Controller
{
    public function index($id)
    {

        $data = Manager::where('user_id', $id)->first();
        $leave_types = LeaveType::where('type', 'WFH')->get();
        $sessions = Section::all();
        return view('wfh.wfh-request', compact('data', 'leave_types', 'sessions'));
    }


    public function store(Request $request)
    {


        $request->validate([
            'user_id' => 'required|exists:users,id',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'reason' => 'required|string',
            'remarks' => 'nullable|string',
        ]);



        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date);

        if ($fromDate == $toDate) {

            if ($request->session == "HALF DAY") {

                $totalDays = 0.5;
            }
        } else {
            $totalDays = 1.0;
        }


        $totalDays = $fromDate->diffInDays($toDate) + 1;



        Workfromhome::create([
            'user_id' => $request->user_id,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'section_id' => $request->session,
            'total' => $totalDays,
            'reason' => $request->reason,
            'remarks' => $request->remarks,
            'leave_type_id' => $request->type,

        ]);

        return redirect()->route('show-request', ['id' => $request->user_id]);
    }
}
