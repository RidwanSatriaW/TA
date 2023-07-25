<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubUserController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\KeperluanController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeAvailableController;
use App\Http\Controllers\VisitorDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/coba', function () {
//     return view('coba');
// });

// login and register 
Route::get('/registration', [CustomAuthController::class, 'registration'])->name('register');

Route::post('/custom-registration', [CustomAuthController::class, 'custom_registration'])->name('register.custom');

Route::get('/login', [CustomAuthController::class, 'index'])->name('login');

Route::post('/custom-login', [CustomAuthController::class, 'custom_login'])->name('login.custom');

// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard/charts', [DashboardController::class, 'getDataCharts'])->name('getDataCharts');

// logout
Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');

// user profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->name('profile.edit');

Route::post('/profile/edit_validation', [ProfileController::class, 'edit_validation'])->name('profile.edit_validation');

// sub user
Route::get('/sub_user', [SubUserController::class, 'index'])->name('sub_user');

Route::get('/sub_user/fetchall', [SubUserController::class, 'fetch_all'])->name('sub_user.fetchall');

Route::get('/sub_user/add', [SubUserController::class, 'add'])->name('sub_user.add');

Route::get('/sub_user/{id}/edit', [SubUserController::class, 'edit'])->name('sub_user.edit');

Route::post('/sub_user/add_validation', [SubUserController::class, 'add_validation'])->name('sub_user.add_validation');

Route::post('/sub_user/edit_validation', [SubUserController::class, 'edit_validation'])->name('sub_user.edit_validation');

Route::get('/sub_user/delete/{id}', [SubUserController::class, 'delete'])->name('sub_user.delete');

// department
Route::get('/department',[DepartmentController::class, 'index'])->name('department');

Route::get('/department/fetch_all', [DepartmentController::class, 'fetch_all'])->name('department.fetch_all');

Route::get('/department/add', [DepartmentController::class, 'add'])->name('department.add');

Route::get('/department/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');

Route::post('/department/add_validation', [DepartmentController::class, 'add_validation'])->name('department.add_validation');

Route::post('/department/edit_validation', [DepartmentController::class, 'edit_validation'])->name('department.edit_validation');

Route::get('/department/activate/{id}', [DepartmentController::class, 'activate'])->name('department.activate'); 

Route::get('/department/deactivate/{id}', [DepartmentController::class, 'deactivate'])->name('department.deactivate'); 

// employee
Route::get('/employee',[EmployeeController::class, 'index'])->name('employee');

Route::get('/employee/fetch_all', [EmployeeController::class, 'fetch_all'])->name('employee.fetch_all');

Route::get('/employee/add', [EmployeeController::class, 'add'])->name('employee.add');

Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');

Route::post('/employee/add_validation', [EmployeeController::class, 'add_validation'])->name('employee.add_validation');

Route::post('/employee/edit_validation', [EmployeeController::class, 'edit_validation'])->name('employee.edit_validation');

Route::get('/employee/activate/{id}', [EmployeeController::class, 'activate'])->name('employee.activate');
Route::get('/employee/deactivate/{id}', [EmployeeController::class, 'deactivate'])->name('employee.deactivate');

// keperluan
Route::get('/necessity',[KeperluanController::class, 'index'])->name('necessity');

Route::get('/necessity/fetch_all', [KeperluanController::class, 'fetch_all'])->name('necessity.fetch_all');

Route::get('/necessity/add', [KeperluanController::class, 'add'])->name('necessity.add');

Route::post('/necessity/add_validation', [KeperluanController::class, 'add_validation'])->name('necessity.add_validation');

Route::get('/necessity/activate/{id}', [KeperluanController::class, 'activate'])->name('necessity.activate');

Route::get('/necessity/deactivate/{id}', [KeperluanController::class, 'deactivate'])->name('necessity.deactivate');

// employee available
Route::get('/available',[EmployeeAvailableController::class, 'index'])->name('employee_available');

Route::get('/available/fetch_all', [EmployeeAvailableController::class, 'fetch_all'])->name('employee_available.fetch_all');

Route::get('/available/add', [EmployeeAvailableController::class, 'add'])->name('employee_available.add');

Route::post('/available/add_validation', [EmployeeAvailableController::class, 'add_validation'])->name('employee_available.add_validation');

Route::get('/available/{id}/edit', [EmployeeAvailableController::class, 'edit'])->name('employee_available.edit');

Route::post('/available/edit_validation', [EmployeeAvailableController::class, 'edit_validation'])->name('employee_available.edit_validation');

Route::get('/available/activate/{id}', [EmployeeAvailableController::class, 'activate'])->name('employee_available.activate');

Route::get('/available/deactivate/{id}', [EmployeeAvailableController::class, 'deactivate'])->name('employee_available.deactivate');

// visitor data

Route::get('/data', [VisitorDataController::class, 'index'])->name('data');

Route::get('/data/fetchall', [VisitorDataController::class, 'fetch_all'])->name('data.fetch_all');

Route::get('/data/add', [VisitorDataController::class, 'add'])->name('data.add');

Route::post('/data/add_validation', [VisitorDataController::class, 'add_validation'])->name('data.add_validation');

Route::get('/data/{id}/edit', [VisitorDataController::class, 'edit'])->name('data.edit');

Route::post('/data/edit_validation', [VisitorDataController::class, 'edit_validation'])->name('data.edit_validation');

// visitor 

Route::get('/visitor', [VisitorController::class, 'index'])->name('visitor');

Route::get('/visitor/fetchall', [VisitorController::class, 'fetch_all'])->name('visitor.fetchall');

Route::get('/visitor/add', [VisitorController::class, 'add'])->name('visitor.add');

Route::get('/visitor/get_available/{id}', [VisitorController::class, 'get_available'])->name('visitor.available');

Route::post('/visitor/add_validation', [VisitorController::class, 'add_validation'])->name('visitor.add_validation');

Route::post('/visitor/add_validation_first', [VisitorController::class, 'add_validation_first'])->name('visitor.add_validation_first');

Route::get('/visitor/{id}/view', [VisitorController::class, 'show'])->name('visitor.show');

Route::get('/visitor/{id}/edit', [VisitorController::class, 'edit'])->name('visitor.edit');

Route::post('/visitor/edit_validation', [VisitorController::class, 'edit_validation'])->name('visitor.edit_validation');

// export 
Route::get('/report', [ReportController::class, 'index'])->name('report');
// Route::get('/export_excel', [ReportController::class, 'export_excel'])->name('export_excel');
Route::post('/export_pdf', [ReportController::class, 'export_pdf'])->name('export_pdf');