<?php

use Illuminate\Support\Facades\Route;

use App\Http\controllers\HomeController;
use App\Http\controllers\StudentController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


route::get('/',[HomeController::class, 'index']);
route::get('/Homedashboard',[HomeController::class, 'Homedashboard'])->middleware('auth','verified');
route::get('/Add_Student',[StudentController::class, 'Add_Student']);
route::post('Save_Student',[StudentController::class, 'Save_Student'])->name('Save_Student');
route::get('/View_students',[StudentController::class, 'View_students'])->name('View_students');
route::get('edit_student/{id}',[StudentController::class,'edit_student'])->name('edit_student');
route::post('Update_Student',[StudentController::class,'Update_Student'])->name('Update_Student');



route::get('/logout',[HomeController::class, 'logout']);