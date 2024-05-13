<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assignment\AssignmentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//===================================== Start Assignment Section =================================
    Route::get('/',[AssignmentController::class,'tester_list'])->name('testerList');
    Route::post('/submit', [AssignmentController::class,'submitForm']);
    Route::post('delete', [AssignmentController::class,'delete_tester'])->name('deleteTester');
    Route::post('view', [AssignmentController::class,'view_tester_details'])->name('viewTesterDetails');
    Route::post('/update', [AssignmentController::class,'updateForm']);
//===================================== End Assignment Section =================================
