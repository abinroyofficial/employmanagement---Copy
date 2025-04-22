<?php

namespace App\Console\Commands;

use App\Models\Attendence;
use App\Models\Manager;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateDailyAttendance extends Command
{

    protected $signature = 'create-daily-attendance';
    protected $description = 'Command description';


    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {

            $date = Carbon::today()->toDateString();

            $existingAttendance = Attendence::where('user_id', $user->id)
                ->where('date', $date)
                ->first();


            if (!$existingAttendance) {
                Attendence::create([
                    'user_id' => $user->id,
                    'date' => $date,
                    'sign_in' => '00:00:00',
                    'sign_out' => '00:00:00',
                    'total_time' => 0.00,
                    'attendance_status' => 7 ,
                ]);
            }
        }
    }
}
