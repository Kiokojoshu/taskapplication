<?php

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/createtask', [App\Http\Controllers\TaskControler::class, 'createtask'])->name('createtasks');
Route::get('/deletetasks', [App\Http\Controllers\HomeController::class, 'deletetasks'])->name('del');
Route::get('/assigntask', [App\Http\Controllers\HomeController::class, 'assigntask'])->name('assi');
Route::post('/assigntask', [App\Http\Controllers\TaskControler::class, 'assigntasks'])->name('assi');
Route::get('/edittasks', [App\Http\Controllers\HomeController::class, 'edittask'])->name('assi');
Route::post('/edittasks', [App\Http\Controllers\TaskControler::class, 'edittasks'])->name('assi');
