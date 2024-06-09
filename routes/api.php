<?php

use App\Http\Controllers\AdvertisementController;
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
use App\Models\Classroom;
use App\Models\Reservation;
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

Route::get('classrooms_buscador', [ClassroomController::class,'index']);
// Route::post('classroon_guardar', [ClassroomController::class,'store']);
Route::apiResource('classrooms',ClassroomController::class);
Route::post('classrooms_disponibles', [ClassroomController::class, 'showAvailableClassroomsEfficiently']);
Route::post('classrooms/{classroom}', [ClassroomController::class, 'showClassroomAvailable']);
Route::post('classroomsCapacity', [ClassroomController::class, 'showClassroomAvailableByCapacity']);
//aulas disponibles aula periodo fecha

Route::apiResource('characteristics',CharacteristicController::class);

Route::apiResource('reservations', ReservationController::class);
Route::get('reservationOrderBy', [ReservationController::class, 'orderBy']);
Route::get('reservations/{classroom_id}/available-periods/{date}', [ReservationController::class, 'periodsForClassroomReservation']);
Route::get('periods2', [PeriodController::class, 'periodsForFilterByCantidad']);
Route::post('reservaSemanal',[ReservationController::class,'weekReservation']);

Route::apiResource('holidays',HolidayController::class);

Route::apiResource('settings', SettingController::class);

Route::get('ordenarUrg',[ReservationController::class,'sortDate']);
Route::apiResource('advertisement',AdvertisementController::class);
