<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Public routes
Route::apiResource('students', StudentController::class)->only(['index', 'show']);

Route::get('groups/{group}/students', [GroupController::class, 'studentsOfGroup']);
Route::get('groups/{group}/teachers', [GroupController::class, 'teachersOfGroup']);
Route::get('teachers/{teacher}/groups', [TeacherController::class, 'groupsOfTeacher']);

Route::post('/teachers/{teacher}/add-group', [TeacherController::class, 'addGroup']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('students', StudentController::class)->except(['index', 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);
});