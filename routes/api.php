<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\empleadoController;

Route::get('/empleado',[empleadoController::class, 'index']);

Route::get('/empleado/{id}',[empleadoController::class, 'show']);

Route::post('/empleado', [empleadoController::class, 'store']);

Route::put('/empleado/{id}',[empleadoController::class,'update']);

Route::patch('/empleado/{id}',[empleadoController::class,'updatePartial']);

Route::delete('/empleado/{id}', [empleadoController::class, 'delete']);