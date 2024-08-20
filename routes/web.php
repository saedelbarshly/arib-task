<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','can:manager-check'])->group(function () {
    Route::controller(DepartmentController::class)->prefix('department')->name('department.')->group(function () {
        Route::get('/','index')->name('index');
        Route::get('/data','data')->name('data');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{department}','edit')->name('edit');
        Route::put('/update/{department}','update')->name('update');
        Route::get('/delete/{department}','delete')->name('delete');
    });
});
Route::middleware('auth')->group(function () {
    Route::controller(EmployeeController::class)->group(function () {
        Route::middleware('can:manager-check')->prefix('employee')->name('employee.')->group(function () {
            Route::get('/','index')->name('index');
            Route::get('/data','data')->name('data');
            Route::get('/create','create')->name('create');
            Route::get('/show//{employee}','show')->name('show');
            Route::post('/store','store')->name('store');
            Route::get('/edit/{employee}','edit')->name('edit');
            Route::put('/update/{employee}','update')->name('update');
            Route::get('/delete/{employee}','delete')->name('delete');
        });

        Route::get('/my-tasks','myTasks')->name('myTasks');
        Route::put('/change-task-status/{task}','changeTaskStatus')->name('change.status');
    });
});

Route::middleware(['auth','can:manager-check'])->group(function () {
    Route::controller(TaskController::class)->prefix('task')->name('task.')->group(function () {
        Route::get('/','index')->name('index');
        Route::get('/data','data')->name('data');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{task}','edit')->name('edit');
        Route::put('/update/{task}','update')->name('update');
        Route::get('/delete/{task}','delete')->name('delete');
        
    });
});

require __DIR__.'/auth.php';
