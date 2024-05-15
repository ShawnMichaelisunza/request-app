<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ChangeShiftController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HalfdayController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\OvertimeController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
// main dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// create a data

// OT
Route::get('/overtime', [OvertimeController::class, 'create'])->name('ot_create');
Route::post('/overtime/create', [OvertimeController::class, 'store'])->name('ot_store');
// CS
Route::get('/change-shift', [ChangeShiftController::class, 'create'])->name('cs_create');
Route::post('/change-shift/create', [ChangeShiftController::class, 'store'])->name('cs_store');
// HD
Route::get('/haft-day', [HalfdayController::class, 'create'])->name('hd_create');
Route::post('/haft-day/create', [HalfdayController::class, 'store'])->name('hd_store');
// L
Route::get('/leave', [LeaveController::class, 'create'])->name('l_create');
Route::post('/leave/create', [LeaveController::class, 'store'])->name('l_store');

// admin----------------

// login
Route::get('/@dminL0gin', [AdminDashboardController::class, 'create'])->name('login');
Route::post('/@dminL0gin/create', [AdminDashboardController::class, 'store'])->name('login.store');

// register
Route::get('/r3gist3r', [UserController::class, 'create'])->name('register_admin');
Route::post('/r3gist3r/create', [UserController::class, 'store'])->name('register_store');

// logout
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//admin Dashboard

Route::get('/adminDashboard', [AdminDashboardController::class, 'index'])->name('admin_dashboard')->middleware('auth', 'admin');
Route::get('/overtime/view', [OvertimeController::class, 'index'])->name('ot_index')->middleware('auth', 'admin');
Route::get('/change-shift/view', [ChangeShiftController::class, 'index'])->name('cs_index')->middleware('auth', 'admin');
Route::get('/halfday/view', [HalfdayController::class, 'index'])->name('hd_index')->middleware('auth', 'admin');
Route::get('/Leave/view', [LeaveController::class, 'index'])->name('l_index')->middleware('auth', 'admin');


// View A data
Route::get('/overtime/{id}', [OvertimeController::class, 'view'])->name('ot_view')->middleware('auth', 'admin');
Route::get('/change-shift/{id}', [ChangeShiftController::class, 'view'])->name('cs_view')->middleware('auth', 'admin');
Route::get('/halfday/{id}', [HalfdayController::class, 'view'])->name('hd_view')->middleware('auth', 'admin');
Route::get('/Leave/{id}', [LeaveController::class, 'view'])->name('l_view')->middleware('auth', 'admin');

// Reject
Route::delete('/ot_delete/{id}', [OvertimeController::class, 'delete'])->name('ot_delete')->middleware('auth', 'admin');
Route::delete('/cs_delete/{id}', [ChangeShiftController::class, 'delete'])->name('cs_delete')->middleware('auth', 'admin');
Route::delete('/hd_delete/{id}', [HalfdayController::class, 'delete'])->name('hd_delete')->middleware('auth', 'admin');
Route::delete('/l_delete/{id}', [LeaveController::class, 'delete'])->name('l_delete')->middleware('auth', 'admin');

// Approve
Route::post('/ot_approve/{id}', [OvertimeController::class, 'approve'])->name('ot_approve')->middleware('auth', 'admin');
Route::post('/cs_approve/{id}', [ChangeShiftController::class, 'approve'])->name('cs_approve')->middleware('auth', 'admin');
Route::post('/hd_approve/{id}', [HalfdayController::class, 'approve'])->name('hd_approve')->middleware('auth', 'admin');
Route::post('/l_approve/{id}', [LeaveController::class, 'approve'])->name('l_approve')->middleware('auth', 'admin');
