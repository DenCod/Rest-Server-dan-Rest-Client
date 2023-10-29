<?php

use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\DataController;
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

// Route::resource('/', EmployeesController::class);


Route::get('/', [DataController::class, 'index']);
Route::get('/tambah', [DataController::class, 'tambah']);
Route::post('/store', [DataController::class, 'store']);
Route::get('/edit/{id}', [DataController::class, 'edit']);
Route::put('/update/{id}', [DataController::class, 'update']);
Route::get('/destroy/{id}', [DataController::class, 'destroy']);
