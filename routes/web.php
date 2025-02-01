<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('students', 'students.index');

Route::controller(StudentController::class)->group(function () {
    Route::get('/students/view', 'view');
    Route::post('/students/store', 'store');
    Route::get('/students/edit/{id}', 'edit');
    Route::post('/students/update/{id}', 'update');
    Route::delete('/students/delete/{id}', 'destroy');
});
