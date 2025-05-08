<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SalaryController extends Controller
{
    public function index($id)
    {
        $datas = Manager::where("user_id", $id)->first();

        $now = Carbon::now();
        $currentMonth = $now->month;
        $currentYear = $now->year;
        $currentMonthName = $now->format('F');
        $totalDaysInMonth = $now->daysInMonth;

        $absent_days = Attendence::where('user_id', $id)->whereIn('attendance_status', [4, 7])->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)->get()->count();
        $attendance_days = Attendence::where('user_id', $id)
            ->whereNotIn('attendance_status', [4, 7])->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->get()->count();
        $atendence_percent = number_format(($attendance_days / $totalDaysInMonth) * 100, 2);
        $perday_sal = $datas->salary / $totalDaysInMonth;
        $lop = $perday_sal * $absent_days;
        $salary_month = number_format($datas->salary - ($lop),2);

        return view('salary.one', compact('datas', 'absent_days', 'attendance_days', 'currentMonth', 'currentYear', 'currentMonthName', 'totalDaysInMonth', 'atendence_percent', 'salary_month'));
    }
}
