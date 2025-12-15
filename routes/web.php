<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CitaController; 
use App\Http\Controllers\Api\MedicoController; 
use App\Http\Controllers\Api\PacienteController; 
use App\Http\Controllers\Api\EspecialidadController; 

// Ruta de bienvenida o inicio
Route::get('/', function () {
    return view('welcome'); 
});


// ==========================================================
// 1. Rutas de Citas
// ==========================================================
Route::get('/citas-web', [CitaController::class, 'indexWeb'])->name('citas.web.index');
Route::get('/citas-web/{cita}', [CitaController::class, 'showWeb'])->name('citas.web.show');


// ==========================================================
// 2. Rutas de Médicos
// ==========================================================
Route::get('/medicos-web', [MedicoController::class, 'indexWeb'])->name('medicos.web.index');
Route::get('/medicos-web/{medico}', [MedicoController::class, 'showWeb'])->name('medicos.web.show');

// ==========================================================
// 3. Rutas de Pacientes
// ==========================================================
Route::get('/pacientes-web', [PacienteController::class, 'indexWeb'])->name('pacientes.web.index');
Route::get('/pacientes-web/{paciente}', [PacienteController::class, 'showWeb'])->name('pacientes.web.show');

// ==========================================================
// 4. Rutas de Especialidades 
// ==========================================================
Route::get('/especialidades-web', [EspecialidadController::class, 'indexWeb'])->name('especialidades.web.index');
Route::get('/especialidades-web/{especialidad}', [EspecialidadController::class, 'showWeb'])->name('especialidades.web.show');
