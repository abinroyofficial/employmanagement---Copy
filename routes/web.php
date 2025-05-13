<?php

use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegulizationController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLeaveController;
use App\Http\Controllers\WorkFromHomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::group(['middleware' => ['role:super admin|manager|senior manager']], function () {
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{id}/delete', [PermissionController::class, 'destroy'])->middleware('permission:delete');


    Route::resource('roles', RoleController::class);
    Route::get('roles/{id}/delete', [RoleController::class, 'destroy'])->middleware('permission:delete');
    Route::get('roles/{id}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{id}/give-permissions', [RoleController::class, 'givePermissionToRole']);


    Route::resource('users', UserController::class);
    Route::get('users/{id}/delete', [UserController::class, 'destroy']);
    Route::get('updateinfo/{id}', [ManagerController::class, 'updateinfo']);
    Route::get('addleaveData/{id}', [UserLeaveController::class, 'index']);
    Route::post('store-leave', [UserLeaveController::class, 'store']);
    Route::post('/store-info', [ManagerController::class, 'store'])->name('store-info');
    Route::get('/add-department', [DepartmentController::class, 'index'])->name('add-department');;
    Route::get('/add-leaveType', [LeaveController::class, 'add_leaveType'])->name('add-leaveType');;
    Route::post('/store-department', [DepartmentController::class, 'store']);
    Route::post('/store-leave-type', [LeaveController::class, 'store_leave_type']);
});


Route::group(['middleware' => ['role:super admin|employ|manager|senior manager']], function () {

    Route::get('/view-profile/{id}', [ManagerController::class, 'viewprofile']);

    Route::get('/attendence/{id}', [AttendenceController::class, 'index'])->name('attendence');
    Route::get('/salary/{id}', [SalaryController::class, 'index'])->name('salary');
    Route::post('/attendance-store', [AttendenceController::class, 'store'])->name('attendence-store');
    Route::get('/attendance-monthly', [AttendenceController::class, 'show'])->name('attendence-monthly');
    Route::get('/attendence-request', [AttendenceController::class, 'attendenceRequest'])->name('attendence-request');
    Route::get('/attendance-daily', [AttendenceController::class, 'attendance_daily']);

    Route::get('/leave/{id}', [LeaveController::class, 'index'])->name('leave');
    Route::post('/leave', [LeaveController::class, 'store'])->name('leave-store');
    Route::get('/show-request/{id}', [LeaveController::class, 'show'])->name('show-request');


    Route::get('/cancel-request', [RequestController::class, 'cancel'])->name('cancel-request');

    Route::get('/wfh/{id}', [WorkFromHomeController::class, 'index'])->name('wfh');
    Route::post('/wfh', [WorkFromHomeController::class, 'store'])->name('wfh-store');

    Route::get('/regulization/{id}', [RegulizationController::class, 'index'])->name('regulization');
    Route::get('/regulizaion-store', [RegulizationController::class, 'store'])->name('regulizaion-store');

    Route::get('/leave-balance/{id}', [UserLeaveController::class, 'show'])->name('leave-balance');
});

Route::group(['middleware' => ['role:manager|senior manager']], function () {
    Route::get('/my-team/{id}', [ManagerController::class, 'myteam'])->name('my-team');
    Route::get('/my-team-requests/{id}', [RequestController::class, 'index'])->name('show-team-request');
    Route::get('/my-team-requests-wfh/{id}', [RequestController::class, 'show'])->name('show-team-request');
    Route::get('/my-team-requests-regulisation/{id}', [RequestController::class, 'regulizationRequest'])->name('show-team-request-reg');
    Route::get('/update-leaveRequest', [RequestController::class, 'update'])->name('update-leaveRequest');
    Route::get('/approve-regulization', [RequestController::class, 'approve'])->name('approve-regulization');
    Route::get('/add_task/{id}', [TaskController::class, 'show'])->name('add_task');
    Route::post('/store', [TaskController::class, 'store'])->name('store_task');
});





Route::get('/task', [TaskController::class, 'index'])->name('task');
Route::get('/view_task', [TaskController::class, 'view_task'])->name('view_task');
Route::get('/task-detailing', [TaskController::class, 'task_detailing']);
Route::post('/store-comment', [CommentController::class, 'store_comment']);
Route::get('/show_comment', [CommentController::class, 'show']);
Route::post('/update_comment', [CommentController::class, 'update']);
Route::post('/reply_comment', [CommentController::class, 'storeReply']);
Route::get('/view_task/{task_id}', [CommentController::class, 'viewTask'])->name('view.task');
Route::get('/search-task', [TaskController::class, 'search_task']);
Route::get('/sort-task', [TaskController::class, 'sort_task']);
Route::post('/task-import', [TaskController::class, 'task_import']);
Route::get('/export-tasks', [TaskController::class, 'export']);
Route::get('attendece_export/{userId}', [AttendenceController::class, 'export']);
Route::get('export_pdf/{userId}', [AttendenceController::class, 'pdf']);

Route::get('/notifications', [TaskController::class, 'fetch'])->name('notifications.fetch');





Route::get('/view_task_not', [TaskController::class, 'view_task_not'])->name('view_task_not');
Route::get('/pagination-ajax', [AttendenceController::class, 'fetchData']);


Route::group(['middleware' => ['role:super admin|senior manager']], function () {
    Route::get('/attendence-all', [AttendenceController::class, 'attendeceAll']);
    Route::get('/attendece_all_details', [AttendenceController::class, 'attendece_all_details']);
    Route::get('/search-user', [AttendenceController::class, 'attendece_user_search']);
    Route::get('emp_details', [ManagerController::class, 'emp_details']);
    Route::get('/get_employ_details', [ManagerController::class, 'all_employ']);
});
