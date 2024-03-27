<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CondSpecialController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::resource('docentes', TeacherController::class);
Route::resource('materias', SubjectController::class);
Route::resource('grupos', GroupController::class);
Route::resource('classroom', ClassroomController::class);
Route::resource('condSpecial',CondSpecialController::class);
