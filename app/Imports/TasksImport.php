<?php

namespace App\Imports;

use App\Models\Task;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TasksImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $task_deadline = $this->convertExcelDateToDate($row[3]);
            $created_at = $this->convertExcelDateToDate($row[7]);
            $updated_at = $this->convertExcelDateToDate($row[8]);

            $initial_task = Task::where('task_name', $row[1])->first();
            if ($initial_task) {
                $initial_task->update([
                    'user_id' => $row[0],
                    'task_name' => $row[1],
                    'task_description' => $row[2],
                    'task_deadline' => $task_deadline,
                    'estimated_time' => $row[4],
                    'task_dependencies' => $row[5],
                    'status' => $row[6],
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ]);
            } else {
                Task::create([
                    'user_id' => $row[0],
                    'task_name' => $row[1],
                    'task_description' => $row[2],
                    'task_deadline' => $task_deadline,
                    'estimated_time' => $row[4],
                    'task_dependencies' => $row[5],
                    'status' => $row[6],
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ]);
            }
        }
    }


    private function convertExcelDateToDate($excelDate)
    {

        if (is_numeric($excelDate)) {
            $unixDate = ($excelDate - 25569) * 86400;
            return gmdate("Y-m-d H:i:s", $unixDate);
        }


        return $excelDate;
    }
}
