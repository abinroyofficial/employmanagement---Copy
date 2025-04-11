<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TasksExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Task::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'User ID',
            'task_name',
            'task_description',
            'task_deadline',
            'estimated_time',
            'task_dependencies',
            'status',
            'created_at',
            'updated_at',
        ];
    }
}
