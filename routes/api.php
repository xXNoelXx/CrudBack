<?php

use App\Http\Controllers\API\EmpleadoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('empleados',  [EmpleadoController::class, 'index']);
Route::post('/add-empleado', [EmpleadoController::class, 'store']);
Route::get('/edit-empleado/{id}', [EmpleadoController::class, 'edit']);
Route::put('update-empleado/{id}', [EmpleadoController::class, 'update']);
Route::delete('delete-empleado/{id}', [EmpleadoController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
