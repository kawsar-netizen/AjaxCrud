<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Teacher Route Here.......

Route::get('teacher',[TeacherController::class,'index']);

route::get('teacher/all',[TeacherController::class,'alldata']);

route::post('teacher/store',[TeacherController::class,'dataStore']);

route::get('teacher/edit/{id}',[TeacherController::class,'dataEdit']);

route::post('teacher/update/{id}',[TeacherController::class,'dataUpdate']);

route::get('teacher/destory/{id}',[TeacherController::class,'datadestory']);