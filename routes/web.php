<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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


Route::get('/teacher/login', function () {
    return view('teacher/login_teacher');
})->name('login.teacher_get');

Route::get('/admin/login', function () {
    return view('administrator/index');
})->name('login.admin_get');  

Route::post('/send-email', [SendEmailController::class, 'sendEmail'])->name('send.email');
Route::post('/student/login',[StudentController::class,'login'])->name('login.student');
Route::get('/student/dashboard',[StudentController::class,'dashboard'])->name('student.dashboard');
Route::get('/student/logout', [StudentController::class, 'logout'])->name('logout.student');
Route::get('send/mail/contact={id}', [SendEmailController::class,'mail_pass'])->name('send.mail_teacher');
Route::post('send/mail/', [SendEmailController::class,'sendEmail_teacher'])->name('send.mail_teacher_due');
Route::get('/generate-pdf',[StudentController::class,'generatePDF'])->name('generate.pdf');
Route::post('/send-chat-message', [StudentController::class, 'sendChatMessage']);
Route::get('/teacher/logout', [TeacherController::class, 'logout'])->name('logout.teacher');
Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
Route::post('/teacher/login', [TeacherController::class,'login'])->name('login.teacher');
Route::post('/teacher/mark', [TeacherController::class,'mark'])->name('insert.mark');
Route::post('/teacher/insert_homework', [TeacherController::class,'insert_homework'])->name('insert.homework');
Route::post('/teacher/dashboard_class', [TeacherController::class,'dashboard_class'])->name('teacher.dashboard_class');
Route::get('/teacher/dashboard_class/{classe}', [TeacherController::class,'dashboard_class_x'])->name('teacher.dashboard_class_x');
Route::post('/admin/fa', [AdministratorController::class,'fafa'])->name('admin.fa');
Route::get('/admin/dashboard', [AdministratorController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdministratorController::class, 'logout'])->name('logout.admin');
Route::get('/admin/opt', [AdministratorController::class, 'opt'])->name('admin.opt');
Route::post('/admin/dashboard_final', [AdministratorController::class, 'admin_dashboard_final'])->name('admin.dashboard_final');
Route::get('/api/students/{studentId}', [AdministratorController::class, 'getStudentMarks']);

