<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TypeProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */


//? Operazione a mano
/*
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{project}', [ProjectController::class, 'show']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);
    Route::put('/projects/{project}', [ProjectController::class, 'update']);
*/

//? Operazione automatica
Route::apiResource('projects', ProjectController::class)->only('index');

Route::get('/projects/{slug}', [ProjectController::class, 'show']);
Route::get('/types/{slug}/projects', TypeProjectController::class);



