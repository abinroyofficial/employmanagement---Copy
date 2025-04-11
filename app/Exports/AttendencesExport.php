<?php

namespace App\Exports;

use App\Models\Attendence;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendencesExport implements FromCollection, WithHeadings
{
    protected $userId;


    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Attendence::where('user_id', $this->userId)
            ->select('user_id', 'date', 'sign_in', 'sign_out', 'total_time', 'attendance_status')
            ->get();
    }

    public function headings(): array
    {
        return [

            'User ID',
            'date',
            'sign_in',
            'sign_out',
            'total_time',
            'status',
        ];
    }
}
