<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// 1. Importación de todos los controladores 
use App\Http\Controllers\Api\CitaController;
use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\EspecialidadController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// 2. Definición de las Rutas de Recursos (Web Semántica)
// Usamos el prefijo 'v1' para versionar la API
Route::prefix('v1')->group(function () {
    
    // Rutas de Recurso para Citas (con JSON-LD)
    Route::apiResource('citas', CitaController::class);
    
    // Rutas de Recurso para Médicos (con JSON-LD)
    Route::apiResource('medicos', MedicoController::class);
    
    // Rutas de Recurso para Pacientes (con JSON-LD)
    Route::apiResource('pacientes', PacienteController::class);
    
    // Rutas de Recurso para Especialidades (con JSON-LD)
    Route::apiResource('especialidades', EspecialidadController::class);
});
