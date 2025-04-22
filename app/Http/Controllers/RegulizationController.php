<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Manager;
use App\Models\Regulization;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegulizationController extends Controller
{
    public function index($id)
    {
        $data = Manager::where('user_id', $id)->first();

        $value = Attendence::where('user_id', $id)->where('date', '!=', Carbon::today()->toDateString())->orwhere('sign_in', '!=', '00:00:00')->whereIn('attendance_status', [7, 8])->get();
        
        return view('regulization.view', compact('value', 'data'));
    }

    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
       
        $type = $request->input('type');
        $regulization_date = $request->input('regulization_date');
        $session = $request->input('session');
        $reason = $request->input('reason');

        Regulization::create([
            "user_id" => $user_id,
            "type" => $type,
            "regulization_date" => $regulization_date,
            "session" => $session,
            "reason" => $reason,
        ]);
        return response()->json([
            'success' => true,
            'message' => "already approved",
            'regulization_date' => $regulization_date
        ]);
    }
}
