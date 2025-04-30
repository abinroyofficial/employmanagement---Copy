<?php

namespace App\Http\Controllers;

use App\Events\NewTaskCreatedEvent;
use App\Exports\TasksExport;
use App\Imports\TasksImport;
use App\Mail\TaskShedule;
use App\Models\Comment;
use App\Models\Manager;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller


{

    public function __construct()
    {


        $this->middleware('permission:create task', ['only' => ['store', 'task_import', 'show']]);
    }

    public function index()
    {
        return view('task.index');
    }

    public function show($id)
    {

        $users = Manager::where('supervisor', $id)->get();
        $tasks = Task::all();

        return view('task.add_task', compact('users', 'tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee' => 'required|exists:users,id',
            'task_name' => 'required|string|max:255',
            'task_description' => 'required|string',
            'task_deadline' => 'required|date|after_or_equal:today',
            'hours' => 'required|integer|min:1',
            'task_dependencies' => 'nullable|'
        ]);
        $task_name = $request->task_name;
        $task_description = $request->task_description;
        $task_deadline = $request->task_deadline;
        $user_name = User::where('id', $request->employee)->first()->name;

        Task::create([
            'user_id' => $request->employee,
            'task_name' => $request->task_name,
            'task_description' => $request->task_description,
            'task_deadline' => $request->task_deadline,
            'estimated_time' => $request->hours,
            'task_dependencies' => $request->task_dependencies

        ]);

        $email_id = User::where('id', $request->employee)->first()->email;
        //Mail::to($email_id)->cc('abinroy4321@gmail.com')->send(new TaskShedule($task_name,$task_description,$task_deadline,$user_name));

        // mails using event and listner 
        NewTaskCreatedEvent::dispatch($task_name, $task_description, $task_deadline, $user_name, $email_id);

        return redirect()->route('add_task', ['id' => $request->employee]);
    }

    public function view_task()
    {
        $task_details = Task::orderBy('created_at', 'desc')->get();

        return view('task.view_task', compact('task_details'));
    }

    public function task_detailing(Request $request)
    {
        $task_id = $request->input('task_id');
        $task_data = Task::where('id', $task_id)->first();
        $comment = Comment::where('task_id', $task_id)->get();


        if ($comment->isNotEmpty()) {
            return response()->json([
                'data' => $task_data,
                'comment' => view('task.comment', compact('comment'))->render()

            ]);
        } else {

            return response()->json([
                'data' => $task_data,
                'comment' => "<h5>no comments yet</h5>"

            ]);
        }
    }





    public function search_task(Request $request)
    {
        $searchTerm = $request->input('search_task');
        $task_details = Task::where('task_name', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('task_description', 'LIKE', '%' . $searchTerm . '%')
            ->get();

        if ($request->ajax()) {
            if ($task_details->isNotEmpty()) {

                return response()->json([
                    'view' => view('task.search', compact('task_details', 'searchTerm'))->render(),
                ]);
            } else {

                return response()->json([
                    'searchresult' => "<h5>No results found</h5>"
                ]);
            }
        }
    }


    public function task_import(Request $request)
    {
        $request->validate([
            'import_task' => [
                'required',
                'file'
            ]
        ]);
        Excel::import(new TasksImport, $request->file('import_task'));
        return redirect()->back();
    }

    public function export()
    {
        $filename = 'tasks.xlsx';
        return Excel::download(new TasksExport, $filename);
    }

    public function sort_task(Request $request)
    {
        $sort_value = $request->input('sort_by');
        switch ($sort_value) {
            case 'name_asc':
                $tasks = Task::orderBy('task_name', 'asc')->get();
                break;
            case 'name_desc':
                $tasks = Task::orderBy('task_name', 'desc')->get();
                break;
            case 'deadline_asc':
                $tasks = Task::orderBy('task_deadline', 'asc')->get();
                break;
            case 'deadline_desc':
                $tasks = Task::orderBy('task_deadline', 'desc')->get();
                break;
            case 'time_asc':
                $tasks = Task::orderBy('estimated_time', 'asc')->get();
                break;
            case 'time_desc':
                $tasks = Task::orderBy('estimated_time', 'desc')->get();
                break;

            default:
                break;
        }
        return response()->json([
            "datas" => $tasks,
        ]);
    }
}
