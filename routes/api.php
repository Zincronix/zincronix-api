<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CharacteristicController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\DocenteMateriaGrupoController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\PeriodController;
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



Route::apiResource('teachers', TeacherController::class);
Route::apiResource('materias', SubjectController::class);
Route::apiResource('grupos', GroupController::class);
Route::apiResource('subject',SubjectController::class);
Route::apiResource('departament',DepartamentController::class);
Route::apiResource('period',PeriodController::class);

Route::get('subjects/{teacher_id}', [DocenteMateriaGrupoController::class, 'subjectsOfTeacher']);
Route::post('groups', [DocenteMateriaGrupoController::class, 'groupsOfSubjectOfTeacher']);

// Route::resource('registro',DocMatGruController::class);

Route::resource('classrooms', ClassroomController::class);
Route::get('classrooms/{period_id}/{date}', [ClassroomController::class, 'showAvailableClassrooms']);
Route::get('classrooms/{classroom_id}/{period_id}/{date}', [ClassroomController::class, 'showClassroomAvailable']);

Route::apiResource('characteristics',CharacteristicController::class);

Route::resource('reservations', ReservationController::class);
Route::get('reservations/{classroom_id}/available-periods/{date}', [ReservationController::class, 'periodsForClassroomReservation']);

Route::get('pedirMateria/{id}',[TeacherController::class,'materiaDocente']);

Route::resource('holidays',HolidayController::class);

