<?php

namespace App\Http\Controllers;

use App\Exports\AttendencesExport;
use App\Models\Attendence;
use App\Models\Manager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AttendenceController extends Controller
{

    public function index($id)
    {
        $data = Manager::where('user_id', $id)->first();

        $monthly_record = Attendence::join('leave_types', 'attendences.attendance_status', '=', 'leave_types.id')->where('user_id', $id)->paginate(3);


        return view('attendence.index', compact('data', 'monthly_record'));
    }
    public function store(Request $request)
    {



        $user = $request->input('user_id');
        $date = $request->input('date');
        $signInTime = $request->input('sign_in');
        $signOutTime = $request->input('sign_out');

        $data = Attendence::where('user_id', $user)
            ->where('date', \Carbon\Carbon::today()->toDateString())
            ->first();
        if ($data) {
            // update the sign out
            $data->sign_out = $signOutTime;

            $signInGot = Carbon::parse($data->sign_in);
            $signOutGot = Carbon::parse($signOutTime);
            $totalHours = $signInGot->diffInHours($signOutGot);

            //update total Hours
            $data->total_time = $totalHours;

            // update the attendence status
            if ($totalHours >= 9.0) {
                $data->attendance_status = 6;
            }
            if ($totalHours >= 4.5 && $totalHours < 9.0) {
                $data->attendance_status = 8;
            }
            if ($totalHours < 4.5) {
                $data->attendance_status = 7;
            }

            $data->save();
        } else {
            $data = Attendence::create([
                'user_id' => $user,
                'date' => $date,
                'sign_in' => $signInTime,
                'sign_out' => $signOutTime,

            ]);
        }



        return response()->json(['message' => 'Attendance successfully recorded!', 'attendance' => $data]);
    }
    public function show(Request $request)
    {
        $month = $request->input('month');
        $id = $request->input('id');
        $month = date('Y-m', strtotime($month));


        if ($month) {
            $monthly_record = Attendence::where('user_id', $id)
                ->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$month])
                ->where('date', '!=', \Carbon\Carbon::today()->toDateString())
                ->with('LeaveType')
                ->get();
        }

        if ($request->ajax()) {
            return view('attendence.monthly-attendence', compact('monthly_record'));
        }
    }
    public function attendenceRequest()
    {
        return view('attendence.attendence-request');
    }

    public function export($userId)
    {
        $filename = 'attendence.xlsx';
        return Excel::download(new AttendencesExport($userId), $filename);
    }

    public function attendance_daily(Request $request)
    {
        $id = $request->input('id');
        $daily_record = Attendence::where('user_id', $id)
            ->where('date', \Carbon\Carbon::today()->toDateString())
            ->first();

        return response()->json([
            'data' => $daily_record
        ]);
    }

    public function pdf($id)
    {

        $data = Attendence::where('user_id', $id)->get();
        $pdf = Pdf::loadView('pdf.attendence', ['datas' => $data]);
        return $pdf->download('attendences.pdf');
    }

    public function fetchData(Request $request)
    {
        $id = $request->input('id');
        $monthly_record = Attendence::join('leave_types', 'attendences.attendance_status', '=', 'leave_types.id')->where('user_id', $id)->paginate(3);
        if ($request->ajax()) {
            return response()->json([
                'html' => $monthly_record,
                'pagination' => $monthly_record->links()->render()
            ]);
        }
    }
}
