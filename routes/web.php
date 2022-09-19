<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubUserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SettingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    //return view('auth.registration');
    return view('auth.login');
})->name('login');
Route::group(['middleware' => 'admin_rights'], function () {
    Route::get('employee', [EmployeeController::class, 'employee'])->name('employee');
    Route::get('employee/add', [EmployeeController::class, 'employee_add'])->name('employee_add');
    Route::post('employee/create', [EmployeeController::class, 'employee_create'])->name('employee_create');

    Route::get('employee/edit/{id}', [EmployeeController::class, 'employee_edit'])->name('employee_edit');
    Route::post('employee/update/{id}', [EmployeeController::class, 'employee_update'])->name('employee_update');
    Route::get('employee/delete/{id}', [EmployeeController::class, 'employee_delete'])->name('employee_delete');

    Route::get('employee/fetchall', [EmployeeController::class, 'fetch_all'])->name('employee.fetchall');
    Route::get('settings', [SettingController::class, 'setting'])->name('setting');
    Route::post('settings/register', [SettingController::class, 'register'])->name('register');

    Route::get('sub_user', [SubUserController::class, 'index'])->name('sub_user');

Route::get('sub_user/fetchall', [SubUserController::class, 'fetch_all'])->name('sub_user.fetchall');

Route::get('sub_user/add', [SubUserController::class, 'add'])->name('sub_user.add');

Route::post('sub_user/add_validation', [SubUserController::class, 'add_validation'])->name('sub_user.add_validation');

Route::get('sub_user/edit/{id}', [SubUserController::class, 'edit'])->name('edit');

Route::post('sub_user/edit_validation', [SubUserController::class, 'edit_validation'])->name('sub_user.edit_validation');

// Route::get('sub_user/delete/{id}', [SubUserController::class, 'delete'])->name('delete');

Route::get('department', [DepartmentController::class, 'index'])->name('department');

Route::get('department/fetch_all', [DepartmentController::class, 'fetch_all'])->name('department.fetch_all');

Route::get('department/add', [DepartmentController::class, 'add'])->name('add');

Route::post('department/add_validation', [DepartmentController::class, 'add_validation'])->name('department.add_validation');

Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');

Route::post('department/edit_validation', [DepartmentController::class, 'edit_validation'])->name('department.edit_validation');

// Route::get('department/delete/{id}', [DepartmentController::class, 'delete'])->name('delete');

Route::post('profile/edit_validation', [ProfileController::class, 'edit_validation'])->name('profile.edit_validation');
});


Route::group(['middleware' => 'sub_user_rights'], function () {
    Route::get('visitor/add', [VisitorController::class, 'add'])->name('add');
    Route::post('visitor/create', [VisitorController::class, 'create'])->name('visitor_create');
    Route::get('/visitor/entry/{id}',[VisitorController::class,'entry'])->name('visitor_entry');
    Route::post('/visitor/entry/create/{id}',[VisitorController::class,'entry_create'])->name('visitor_entry_create');
    Route::post('/visitor/out/{id}',[VisitorController::class,'visitor_out'])->name('visitor_out');

});




// Route::get('registration', [CustomAuthController::class, 'registration'])->name('register');

// Route::post('custom-registration', [CustomAuthController::class, 'custom_registration'])->name('register.custom');

// Route::get('login', [CustomAuthController::class, 'index'])->name('login');

Route::post('custom-login', [CustomAuthController::class, 'custom_login'])->name('login.custom');

// Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');

Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');

Route::get('profile', [ProfileController::class, 'index'])->name('profile');



// Route::get('sub_user', [SubUserController::class, 'index'])->name('sub_user');

// Route::get('sub_user/fetchall', [SubUserController::class, 'fetch_all'])->name('sub_user.fetchall');

// Route::get('sub_user/add', [SubUserController::class, 'add'])->name('sub_user.add');

// Route::post('sub_user/add_validation', [SubUserController::class, 'add_validation'])->name('sub_user.add_validation');

// Route::get('sub_user/edit/{id}', [SubUserController::class, 'edit'])->name('edit');

// Route::post('sub_user/edit_validation', [SubUserController::class, 'edit_validation'])->name('sub_user.edit_validation');

// Route::get('sub_user/delete/{id}', [SubUserController::class, 'delete'])->name('delete');

// Route::get('department', [DepartmentController::class, 'index'])->name('department');

// Route::get('department/fetch_all', [DepartmentController::class, 'fetch_all'])->name('department.fetch_all');

// Route::get('department/add', [DepartmentController::class, 'add'])->name('add');

// Route::post('department/add_validation', [DepartmentController::class, 'add_validation'])->name('department.add_validation');

// Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');

// Route::post('department/edit_validation', [DepartmentController::class, 'edit_validation'])->name('department.edit_validation');

// Route::get('department/delete/{id}', [DepartmentController::class, 'delete'])->name('delete');

Route::get('visitor', [VisitorController::class, 'index'])->name('visitor');
Route::get('/visitor/info',[VisitorController::class,'visitor_info'])->name('visitor_info');
Route::post('visitor_meet', [VisitorController::class, 'visitor_meet'])->name('visitor_meet');
// Route::get('visitor/fetchall', [VisitorController::class, 'fetch_all'])->name('visitor.fetchall');
/////1 Route::get('visitor/add', [VisitorController::class, 'add'])->name('add');
// Route::post('visitor/add_validation', [VisitorController::class, 'add_validation'])->name('visitor.add_validation');
// Route::get('visitor_meet_first', [VisitorController::class, 'visitor_meet_first'])->name('visitor_meet_first');
/////1 Route::post('visitor_meet', [VisitorController::class, 'visitor_meet'])->name('visitor_meet');
/////1 Route::post('visitor/create', [VisitorController::class, 'create'])->name('visitor_create');
// Route::get('/visitor/edit/{id}',[VisitorController::class,'edit'])->name('visitor_edit')->middleware('guarding');
// Route::post('/visitor/update/{id}',[VisitorController::class,'update'])->name('visitor_update')->middleware('guarding');
// Route::post('/visitor/delete/{id}',[VisitorController::class,'delete'])->name('visitor_delete')->middleware('guarding');

/////1 Route::get('/visitor/entry/{id}',[VisitorController::class,'entry'])->name('visitor_entry');
// Route::get('/visitor/old_entry',[VisitorController::class,'old_entry'])->name('visitor_old_entry');
// Route::post('/visitor/old_entry/create',[VisitorController::class,'old_entry_create'])->name('visitor_old_entry_create');

/////1 Route::post('/visitor/entry/create/{id}',[VisitorController::class,'entry_create'])->name('visitor_entry_create');
/////1 Route::post('/visitor/out/{id}',[VisitorController::class,'visitor_out'])->name('visitor_out');

Route::get('information', [InformationController::class, 'information'])->name('information');
// Route::get('employee', [EmployeeController::class, 'employee'])->name('employee')->middleware('admin_rights');
// Route::get('employee/add', [EmployeeController::class, 'employee_add'])->name('employee_add')->middleware('admin_rights');
// Route::post('employee/create', [EmployeeController::class, 'employee_create'])->name('employee_create')->middleware('admin_rights');

// Route::get('employee/edit/{id}', [EmployeeController::class, 'employee_edit'])->name('employee_edit')->middleware('admin_rights');
// Route::post('employee/update/{id}', [EmployeeController::class, 'employee_update'])->name('employee_update')->middleware('admin_rights');
// Route::get('employee/delete/{id}', [EmployeeController::class, 'employee_delete'])->name('employee_delete')->middleware('admin_rights');

// Route::get('employee/fetchall', [EmployeeController::class, 'fetch_all'])->name('employee.fetchall')->middleware('admin_rights');
// Route::get('settings', [SettingController::class, 'setting'])->name('setting')->middleware('admin_rights');
// Route::post('settings/register', [SettingController::class, 'register'])->name('register')->middleware('admin_rights');
