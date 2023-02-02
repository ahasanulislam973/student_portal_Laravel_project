<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Models\student;
use App\Models\course;
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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('student_list',[StudentController::class,'index']);
Route::get('add_student',[StudentController::class,'add_student']);
Route::post('save_student',[StudentController::class,'save_student']);
Route::get('edit_student/{id}',[StudentController::class,'edit_student']);
Route::post('update_students',[StudentController::class,'update_students']);
Route::get('delete_student/{id}',[StudentController::class,'delete_student']);
Route::get('search_student',[StudentController::class,'search_student']);
Route::post('save_course',[StudentController::class,'save_course']);
Route::get('view_course/{id}',[StudentController::class,'view_course']);
Route::get('course_list',[StudentController::class,'course_list']);
Route::post('assign_course',[StudentController::class,'assign_course']);
