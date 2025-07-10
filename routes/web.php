<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RecordController;

use App\Http\Controllers\ResetPasswordController;

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ------------------------Password Reset routes------------------------------------------------
Route::get('/forgot-password', function () { return view('components.auth.forgot-password'); })->name('password.request');

Route::post('/forgot-password/email', [ResetPasswordController::class, 'passwordEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetToken'])->name('password.reset');
 
Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->middleware('guest')->name('password.update');
// ------------------------Password Reset routes------------------------------------------------

// ------------------------AUTHENTICATION------------------------------------------------
Route::middleware('guest')->controller(AuthController::class)->group(function(){
	// Route::get('/','showLogin')->name('showLogin');
	Route::get('/','showLogin')->name('login');
	Route::post('/loginStore','login')->name('loginStore');
	Route::post('/register','register')->name('register');
	Route::get('/register','showRegister')->name('showRegister');
});

// ------------------------COMMON------------------------
Route::middleware('auth')->controller(CommonController::class)->group(function(){
	Route::get('/dashboard', 'dashboard')->name('dashboard');
	Route::get('/print-area/{id}', 'printArea')->name('printArea');
});

// ------------------------PROJECT------------------------
Route::middleware('auth')->controller(ProjectController::class)->group(function(){
	Route::get('/project', 'project')->name('project');
	Route::post('/project','makeProject')->name('makeProject');
	Route::post('/editProject/{id}','editProject')->name('editProject');
	Route::get('/deleteProject/{id}','deleteProject')->name('deleteProject');
	Route::get('/deleteProjectImg/{id}','deleteProjectImg')->name('deleteProjectImg');
	Route::get('/single-project/{id}', 'singleProject')->name('singleProject');
});

// ------------------------RECORD------------------------
Route::middleware('auth')->controller(RecordController::class)->group(function(){
	Route::post('/record/{id}','makeRecord')->name('makeRecord');
	Route::get('/single-record/{rid}', 'singleRecord')->name('singleRecord');
	Route::get('/editRecord/{rid}','editRecord')->name('editRecord');
	Route::post('/updateRecord/{rid}','updateRecord')->name('updateRecord');
	Route::get('/deleteRecord/{rid}','deleteRecord')->name('deleteRecord');
	
	Route::get('/make-record/pdf/{id}', 'makePdf')->name('makePdf');
	Route::get('/pdfDownload', 'pdfDownload');
});

// ------------------------PARTY------------------------
Route::middleware('auth')->controller(PartyController::class)->group(function(){
	Route::get('/party', 'index')->name('party');
	Route::post('/party/get_country','get_country')->name('get_country');
	Route::post('/party/get_state/{id}','get_state')->name('get_state');

	Route::post('/party/create','create')->name('createParty');
	Route::post('/party/edit/{prt_id}','editParty')->name('editParty');
	Route::post('/party/update/{slug}','updateParty')->name('updateParty');
	Route::get('/party/delete/{prt_id}','deleteParty')->name('deleteParty');
	Route::get('/party/deleteImg/{prt_id}','deleteImage')->name('deleteImg');
});

// ------------------------Attendance------------------------
Route::middleware('auth')->controller(AttendanceController::class)->group(function(){
	Route::get('/attendance', 'index')->name('attendance');
	Route::get('/attendance/report', 'report')->name('attendance.report');
	Route::get('/attendance/show', [AttendanceController::class, 'show'])->name('attendance.show');
	Route::get('/attendance/fetch', [AttendanceController::class, 'fetch'])->name('attendance.fetch');

	Route::post('/attendance/create','create')->name('attendance.create');
	Route::post('/party/edit/{prt_id}','editParty')->name('editParty');
	Route::post('/party/update/{slug}','updateParty')->name('updateParty');
	Route::get('/party/delete/{prt_id}','deleteParty')->name('deleteParty');
	Route::get('/party/deleteImg/{prt_id}','deleteImage')->name('deleteImg');
});


