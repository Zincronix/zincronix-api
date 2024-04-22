<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CharacteristicController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\DocenteMateriaGrupoController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Models\Setting;
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

Route::get('subjects/{teacher_id}', [DocenteMateriaGrupoController::class, 'subjectsOfTeacher']);
Route::post('departamentSubjects', [SubjectController::class, 'showDepartamentSubject']);
Route::post('groups', [DocenteMateriaGrupoController::class, 'groupsOfSubjectOfTeacher']);
Route::get('unoccupiedGroups/{subject}', [DocenteMateriaGrupoController::class, 'unoccupiedSubjectGroups']);
Route::post('unoccupiedGroups2', [DocenteMateriaGrupoController::class, 'unoccupiedSubjectGroups2']);

Route::apiResource('classrooms', ClassroomController::class);
Route::get('classrooms', [ClassroomController::class, 'showAvailableClassroomsEfficiently']);
Route::get('classrooms/{classroom_id}/{period_id}/{date}', [ClassroomController::class, 'showClassroomAvailable']);

Route::apiResource('characteristics',CharacteristicController::class);

Route::apiResource('reservations', ReservationController::class);
Route::get('reservations/{classroom_id}/available-periods/{date}', [ReservationController::class, 'periodsForClassroomReservation']); //todo
Route::get('reservationOrderBy', [ReservationController::class, 'orderBy']);

Route::apiResource('holidays',HolidayController::class);

Route::get('settings', [SettingController::class, 'index']);

