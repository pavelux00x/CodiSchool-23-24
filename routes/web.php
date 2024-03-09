<?php

use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
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
    return view('codischool_index');
})->name('index');

Route::get('/student/login', function () {
    return view('codischool_loginstudent');
})->name('login.student_get');

Route::post('/send-email', [SendEmailController::class, 'sendEmail'])->name('send.email');
Route::post('/student/login',[StudentController::class,'login'])->name('login.student');
Route::get('/student/dashboard',[StudentController::class,'dashboard'])->name('student.dashboard');
Route::get('/student/logout', [StudentController::class, 'logout'])->name('logout.student');
Route::get('send/mail/contact={id}', [SendEmailController::class,'mail_pass'])->name('send.mail_teacher');
Route::post('send/mail/', [SendEmailController::class,'sendEmail_teacher'])->name('send.mail_teacher_due');
Route::get('/generate-pdf',[StudentController::class,'generatePDF'])->name('generate.pdf');
Route::post('/send-chat-message', [StudentController::class, 'sendChatMessage']);
