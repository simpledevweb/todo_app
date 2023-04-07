<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/users/register', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/getme', [UserController::class, 'getme']);
    Route::post('/tasks', [TaskController::class, 'addtask']);
    Route::get('/tasks', [TaskController::class, 'gettask']);
    Route::patch('/tasks/update/{task}', [TaskController::class, 'updatetask']);
    Route::patch('/tasks/delete/{task}', [TaskController::class, 'deletetask']);
});
