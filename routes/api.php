<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\empleadoController;
use App\Http\Controllers\Api\cargoController;
use App\Http\Controllers\Api\metaoficinaController;
use App\Http\Controllers\Api\metamunicipioController;
use App\Http\Controllers\Api\metadptoController;
use App\Http\Controllers\Api\oficinaController;
use App\Http\Controllers\Api\municipioController;
use App\Http\Controllers\Api\departamentoController;
use App\Http\Controllers\Api\regionController;
use App\Http\Controllers\Api\paisController;
use App\Http\Controllers\Api\metaGerenciaOficinaController;
use App\Http\Controllers\Api\metaGerenciaRegionalController;
use App\Http\Controllers\Api\metaGerenciaZonalController;
use App\Http\Controllers\Api\metaPresidenciaController;
use App\Http\Controllers\Api\registroEjecucion;


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

//metadpto

Route::get('/metadpto',[metadptoController::class, 'index']);

Route::get('/metadpto/{id}',[metadptoController::class, 'show']);

Route::post('/metadpto', [metadptoController::class, 'store']);

Route::put('/metadpto/{id}',[metadptoController::class,'update']);

Route::patch('/metadpto/{id}',[metadptoController::class,'updatePartial']);

Route::delete('/metadpto/{id}', [metadptoController::class, 'delete']);

//oficina

Route::get('/oficina',[oficinaController::class, 'index']);

Route::get('/oficina/{id}',[oficinaController::class, 'show']);

Route::post('/oficina', [oficinaController::class, 'store']);

Route::put('/oficina/{id}',[oficinaController::class,'update']);

Route::patch('/oficina/{id}',[oficinaController::class,'updatePartial']);

Route::delete('/oficina/{id}', [oficinaController::class, 'delete']);

//municipio

Route::get('/municipio',[municipioController::class, 'index']);

Route::get('/municipio/{id}',[municipioController::class, 'show']);

Route::post('/municipio', [municipioController::class, 'store']);

Route::put('/municipio/{id}',[municipioController::class,'update']);

Route::patch('/municipio/{id}',[municipioController::class,'updatePartial']);

Route::delete('/municipio/{id}', [municipioController::class, 'delete']);

//departamento

Route::get('/departamento',[departamentoController::class, 'index']);

Route::get('/departamento/{id}',[departamentoController::class, 'show']);

Route::post('/departamento', [departamentoController::class, 'store']);

Route::put('/departamento/{id}',[departamentoController::class,'update']);

Route::patch('/departamento/{id}',[departamentoController::class,'updatePartial']);

Route::delete('/departamento/{id}', [departamentoController::class, 'delete']);

//region

Route::get('/region',[regionController::class, 'index']);

Route::get('/region/{id}',[regionController::class, 'show']);

Route::post('/region', [regionController::class, 'store']);

Route::put('/region/{id}',[regionController::class,'update']);

Route::patch('/region/{id}',[regionController::class,'updatePartial']);

Route::delete('/region/{id}', [regionController::class, 'delete']);

//pais

Route::get('/pais',[paisController::class, 'index']);

Route::get('/pais/{id}',[paisController::class, 'show']);

Route::post('/pais', [paisController::class, 'store']);

Route::put('/pais/{id}',[paisController::class,'update']);

Route::patch('/pais/{id}',[paisController::class,'updatePartial']);

Route::delete('/pais/{id}', [paisController::class, 'delete']);
//meta_presidencia

Route::get('/meta_presidencia',[metaPresidenciaController::class, 'index']);

Route::get('/meta_presidencia/{id}',[metaPresidenciaController::class, 'show']);

Route::post('/meta_presidencia', [metaPresidenciaController::class, 'store']);

Route::put('/meta_presidencia/{id}',[metaPresidenciaController::class,'update']);

Route::patch('/meta_presidencia/{id}',[metaPresidenciaController::class,'updatePartial']);

Route::delete('/meta_presidencia/{id}', [metaPresidenciaController::class, 'delete']);


//meta_gerencia_regional

Route::get('/meta_gerencia_regional',[metaGerenciaRegionalController::class, 'index']);

Route::get('/meta_gerencia_regional/{id}',[metaGerenciaRegionalController::class, 'show']);

Route::post('/meta_gerencia_regional', [metaGerenciaRegionalController::class, 'store']);

Route::put('/meta_gerencia_regional/{id}',[metaGerenciaRegionalController::class,'update']);

Route::patch('/meta_gerencia_regional/{id}',[metaGerenciaRegionalController::class,'updatePartial']);

Route::delete('/meta_gerencia_regional/{id}', [metaGerenciaRegionalController::class, 'delete']);

//meta_gerencia_zonal

Route::get('/meta_gerencia_zonal',[metaGerenciaZonalController::class, 'index']);

Route::get('/meta_gerencia_zonal/{id}',[metaGerenciaZonalController::class, 'show']);

Route::post('/meta_gerencia_zonal', [metaGerenciaZonalController::class, 'store']);

Route::put('/meta_gerencia_zonal/{id}',[metaGerenciaZonalController::class,'update']);

Route::patch('/meta_gerencia_zonal/{id}',[metaGerenciaZonalController::class,'updatePartial']);

Route::delete('/meta_gerencia_zonal/{id}', [metaGerenciaZonalController::class, 'delete']);
//meta_gerencia_oficina

Route::get('/meta_gerencia_oficina',[metaGerenciaoficinaController::class, 'index']);

Route::get('/meta_gerencia_oficina/{id}',[metaGerenciaoficinaController::class, 'show']);

Route::post('/meta_gerencia_oficina', [metaGerenciaoficinaController::class, 'store']);

Route::put('/meta_gerencia_oficina/{id}',[metaGerenciaoficinaController::class,'update']);

Route::patch('/meta_gerencia_oficina/{id}',[metaGerenciaoficinaController::class,'updatePartial']);

Route::delete('/meta_gerencia_oficina/{id}', [metaGerenciaoficinaController::class, 'delete']);

//registro_ejecucion

Route::get('/registro_ejecucion',[registroEjecucion::class, 'index']);

Route::get('/registro_ejecucion/{id}',[registroEjecucion::class, 'show']);

Route::post('/registro_ejecucion', [registroEjecucion::class, 'store']);

Route::put('/registro_ejecucion/{id}',[registroEjecucion::class,'update']);

Route::patch('/registro_ejecucion/{id}',[registroEjecucion::class,'updatePartial']);

Route::delete('/registro_ejecucion/{id}', [registroEjecucion::class, 'delete']);