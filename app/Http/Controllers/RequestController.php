<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Regulization;
use App\Models\Status;
use App\Models\User;
use App\Models\UserLeave;
use App\Models\Workfromhome;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RequestController extends Controller
{
    public function __construct()
    {


        $this->middleware('permission:team request', ['only' => ['index', 'approve', 'regulizationRequest', 'show', 'update', 'approve']]);
    }

    public function index($id)
    {

        $leave_data = Leave::join('managers', 'leaves.user_id', '=', 'managers.user_id')
            ->join('leave_types', 'leaves.leave_type_id', '=', 'leave_types.id')->with('Status')->with('Section')
            ->where('managers.supervisor', $id)
            ->get();

        $status = Status::all();

        
        if ($leave_data->isNotEmpty()) {
            $userNames = [];

            foreach ($leave_data as $member) {
                $user = User::find($member->user_id);
                $userNames[$member->user_id] = $user->name;
            }
            return view('requests.index', compact('leave_data', 'userNames', 'status'));
        }
    }
    public function show($id)
    {
        $wfh_data = Workfromhome::join('managers', 'workfromhomes.user_id', '=', 'managers.user_id')
            ->join('leave_types', 'workfromhomes.leave_type_id', '=', 'leave_types.id')->with('Status')->with('Section')
            ->where('managers.supervisor', $id)
            ->get();
        $status = Status::all();

        if ($wfh_data->isNotEmpty()) {

            $userNames = [];
            foreach ($wfh_data as $member) {
                $user = User::find($member->user_id);
                $userNames[$member->user_id] = $user->name;
            }
            return view('requests.wfh_request', compact('wfh_data', 'userNames', 'status'));
        }
    }
    public function regulizationRequest($id)
    {


        $reg_data = Regulization::join('managers', 'regulizations.user_id', '=', 'managers.user_id')
            ->where('managers.supervisor', $id)
            ->get();
        if ($reg_data->isNotEmpty()) {
            $userNames = [];
            foreach ($reg_data as $member) {
                $user = User::find($member->user_id);
                $userNames[$member->user_id] = $user->name;
            }
            return view('requests.reg_request', compact('reg_data', 'userNames'));
        }
    }


    public function update(Request $request)
    {
        $user_id = $request->input('user_id');
        $from_date = $request->input('from_date');
        $To_date = $request->input('To_date');
        $type = $request->input('type');
        $total = $request->input('total');
        $status_id = $request->input('status_id');



        //wfh

        if ($type == 5) {
            $WFHTypeId = 5;
            if ($from_date != $To_date) {
                $attendance_records = Attendence::where('user_id', $user_id)
                    ->whereBetween('date', [$from_date, $To_date])
                    ->get();
                foreach ($attendance_records as $record) {
                    if ($status_id == 1) {
                        $record->attendance_status =  $WFHTypeId;
                        $record->save();
                        $leave_status = Workfromhome::where('user_id', $user_id)->where('from_date', $from_date)->first();
                        $leave_status->status_id = $status_id;
                        $leave_status->save();
                    } else {
                        $leave_status = Workfromhome::where('user_id', $user_id)->where('from_date', $from_date)->first();
                        $leave_status->status_id = $status_id;
                        $leave_status->save();
                    }
                }
            } else {


                $row = Attendence::where('user_id', $user_id)->where('date', $from_date)->first();
                if ($row && $type && $status_id == 1) {
                    $row->attendance_status = $WFHTypeId;
                    $row->save();
                    $leave_status = Workfromhome::where('user_id', $user_id)->where('from_date', $from_date)->first();
                    $leave_status->status_id = $status_id;
                    $leave_status->save();
                } else {
                    $leave_status = Workfromhome::where('user_id', $user_id)->where('from_date', $from_date)->first();
                    $leave_status->status_id = $status_id;
                    $leave_status->save();
                }
            }

            // leave 
        } else {

            $casualLeaveTypeId = 1;
            $sickLeaveTypeId = 2;
            $earnedLeaveTypeId = 3;
            $LOPTypeId = 4;
            if ($from_date != $To_date) {
                $attendance_records = Attendence::where('user_id', $user_id)
                    ->whereBetween('date', [$from_date, $To_date])
                    ->get();
                if ($type == 1 && $status_id == 1) {
                    foreach ($attendance_records as $record) {
                        $record->attendance_status = $casualLeaveTypeId;
                        $record->save();
                    }
                    $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                    $leave_status->status_id = $status_id;
                    $leave_status->save();

                    if ($type == 1 && $leave_status->status == 1) {
                        $leave_balance = UserLeave::where('user_id', $user_id)->first();
                        $leave_balance->casual_leave = $leave_balance->casual_leave - $total;
                        $leave_balance->save();
                    }
                } else {
                    $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                    $leave_status->status_id = $status_id;
                    $leave_status->save();
                }
                if ($type == 2 && $status_id == 1) {

                    foreach ($attendance_records as $record) {
                        $record->attendance_status =  $sickLeaveTypeId;
                        $record->save();
                    }
                    $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                    $leave_status->status_id = $status_id;
                    $leave_status->save();

                    if ($leave_status->status == 1) {
                        $leave_balance = UserLeave::where('user_id', $user_id)->first();
                        $leave_balance->sick_leave = $leave_balance->sick_leave - $total;
                        $leave_balance->save();
                    }
                } else {
                    $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                    $leave_status->status_id = $status_id;
                    $leave_status->save();
                }
                if ($type == 3 && $status_id == 1) {
                    foreach ($attendance_records as $record) {
                        $record->attendance_status =  $earnedLeaveTypeId;
                        $record->save();
                    }
                    $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                    $leave_status->status_id = $status_id;
                    $leave_status->save();

                    if ($leave_status->status == 1) {
                        $leave_balance = UserLeave::where('user_id', $user_id)->first();
                        $leave_balance->earned_leave = $leave_balance->earned_leave - $total;
                        $leave_balance->save();
                    }
                } else {
                    $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                    $leave_status->status_id = $status_id;
                    $leave_status->save();
                }

                if ($type == 4 && $status_id == 1) {
                    foreach ($attendance_records as $record) {
                        $record->attendance_status = $LOPTypeId;
                        $record->save();
                        $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                        $leave_status->status_id = $status_id;
                        $leave_status->save();
                    }
                } else {
                    $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                    $leave_status->status = $status_id;
                    $leave_status->save();
                }
            } else {


                $row = Attendence::where('user_id', $user_id)->where('date', $from_date)->first();
                if ($row && $type) {
                    if ($type == 1  && $status_id == 1) {
                        $row->attendance_status = $casualLeaveTypeId;
                        $row->save();
                        $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                        $leave_status->status_id = $status_id;
                        $leave_status->save();
                        if ($leave_status->status = 1) {
                            $leave_balance = UserLeave::where('user_id', $user_id)->first();
                            $leave_balance->casual_leave = $leave_balance->casual_leave - $total;
                            $leave_balance->save();
                        }

                        return true;
                    } else {
                        $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                        $leave_status->status_id = $status_id;
                        $leave_status->save();
                    }
                    if ($type == 2 && $status_id == 1) {

                        $row->attendance_status =  $sickLeaveTypeId;
                        $row->save();
                        $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                        $leave_status->status_id = $status_id;
                        $leave_status->save();
                        if ($leave_status->status = 1) {
                            $leave_balance = UserLeave::where('user_id', $user_id)->first();
                            $leave_balance->sick_leave = $leave_balance->sick_leave - $total;
                            $leave_balance->save();
                        }

                        return true;
                    } else {
                        $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                        $leave_status->status_id = $status_id;
                        $leave_status->save();
                    }
                    if ($type == 3 && $status_id == 1) {

                        $row->attendance_status =  $earnedLeaveTypeId;
                        $row->save();
                        $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                        $leave_status->status_id = $status_id;
                        $leave_status->save();
                        if ($leave_status->status = 1) {
                            $leave_balance = UserLeave::where('user_id', $user_id)->first();
                            $leave_balance->earned_leave = $leave_balance->earned_leave - $total;
                            $leave_balance->save();
                        }

                        return true;
                    } else {
                        $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                        $leave_status->status_id = $status_id;
                        $leave_status->save();
                    }
                    if ($type == 4 && $status_id == 1) {
                        $row->attendance_status = $LOPTypeId;
                        $row->save();
                        $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                        $leave_status->status_id = $status_id;
                        $leave_status->save();
                    }
                    else{
                        $leave_status = Leave::where('user_id', $user_id)->where('from_date', $from_date)->first();
                        $leave_status->status_id = $status_id;
                        $leave_status->save();
                    }
                }
            }
        }
        return response()->json([
            'success' => true,
            'message' => " regulization applied succesfully",
            'status' => $leave_status->status,
            'date' => $from_date
        ]);
    }


    public function approve(Request $request)
    {
        $user_id = $request->input('user_id');
        $reg_date = $request->input('date');

        $attendance_data = Attendence::where('user_id', $user_id)->where('date', $reg_date)->first();
        $attendance_data->attendance_status = 9;
        $attendance_data->save();

        $status_update = Regulization::where('user_id', $user_id)->where('regulization_date', $reg_date)->first();
        $status_update->status = "approved";
        $status_update->save();
        return response()->json([
            'success' => true,
            'message' => " regulization applied succesfully",
            'regulization_date' => $reg_date
        ]);
    }

    public function cancel(Request $request)
    {
        $id = $request->input('table_id');
        $type = $request->input('type');

        if ($type == "WORK FROM HOME") {
            $data = Workfromhome::where('id', $id)->first();
            $data->delete();
        }
        if ($type == "regulization") {
            $data = Regulization::where('id', $id)->first();
            $data->delete();
        } else {
            $data = Leave::where('id', $id)->first();
            $data->delete();
        }
        return response()->json(['success' => true, 'message' => 'Work from home request canceled successfully']);
    }
}
