<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class DepartmentController extends Controller
{

    public function __construct()
    {


        $this->middleware('permission:create department', ['only' => ['store', 'index',]]);
    }

    public function index()
    {
        return view('department.index');
    }

    public function store()
    {
        Department::create([
            'dept_name' => request()->dept_name,
            'code' => request()->dept_code,
        ]);
     
        return redirect()->route('add-department');
    }
}
