<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\empleadoController;
use App\Http\Controllers\Api\cargoController;
use App\Http\Controllers\Api\metaoficinaController;
use App\Http\Controllers\Api\metamunicipioController;

//empleado

Route::get('/empleado',[empleadoController::class, 'index']);

Route::get('/empleado/{id}',[empleadoController::class, 'show']);

Route::post('/empleado', [empleadoController::class, 'store']);

Route::put('/empleado/{id}',[empleadoController::class,'update']);

Route::patch('/empleado/{id}',[empleadoController::class,'updatePartial']);

Route::delete('/empleado/{id}', [empleadoController::class, 'delete']);

//cargos

Route::get('/cargo',[cargoController::class, 'index']);

Route::get('/cargo/{id}',[cargoController::class, 'show']);

Route::post('/cargo', [cargoController::class, 'store']);

Route::put('/cargo/{id}',[cargoController::class,'update']);

Route::patch('/cargo/{id}',[cargoController::class,'updatePartial']);

Route::delete('/cargo/{id}', [cargoController::class, 'destroy']);

//metaoficina

Route::get('/metaoficina',[metaoficinaController::class, 'index']);

Route::get('/metaoficina/{id}',[metaoficinaController::class, 'show']);

Route::post('/metaoficina', [metaoficinaController::class, 'store']);

Route::put('/metaoficina/{id}',[metaoficinaController::class,'update']);

Route::patch('/metaoficina/{id}',[metaoficinaController::class,'updatePartial']);

Route::delete('/metaoficina/{id}', [metaoficinaController::class, 'delete']);

//metamunicipio

Route::get('/metamunicipio',[metamunicipioController::class, 'index']);

Route::get('/metamunicipio/{id}',[metamunicipioController::class, 'show']);

Route::post('/metamunicipio', [metamunicipioController::class, 'store']);

Route::put('/metamunicipio/{id}',[metamunicipioController::class,'update']);

Route::patch('/metamunicipio/{id}',[metamunicipioController::class,'updatePartial']);

Route::delete('/metamunicipio/{id}', [metamunicipioController::class, 'delete']);