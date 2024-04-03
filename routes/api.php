<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CharacteristicController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
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

Route::resource('classrooms', ClassroomController::class);
Route::get('classrooms/{classroom_id}/{period_id}/{date}', [ClassroomController::class, 'showClassroomAvailable']);

Route::resource('characteristics',CharacteristicController::class);

Route::resource('reservations', ReservationController::class);
Route::get('reservations/{classroom_id}/available-periods/{date}', [ReservationController::class, 'periodsForClassroomReservation']);

