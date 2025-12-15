<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; // Para las respuestas JSON de la API
use Illuminate\View\View;         // Para las respuestas de vista web

class PacienteController extends Controller
{
   
    // Métodos para la API REST (Rutas routes/api.php)
    
    /**
     * Display a listing of the resource (API JSON).
     */
    public function index(): JsonResponse
    {
        $pacientes = Paciente::paginate(15); 

        $data = $pacientes->getCollection()->map(function (Paciente $paciente) {
            return [
                'paciente' => $paciente, 
                'json_ld' => $paciente->toJsonLd(),
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Lista de pacientes con datos semánticos JSON-LD',
            'data' => $data,
            'pagination' => [
                'total' => $pacientes->total(),
                'per_page' => $pacientes->perPage(),
                'current_page' => $pacientes->currentPage(),
                'last_page' => $pacientes->lastPage(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json(['message' => 'Creación de paciente no implementada.'], 501);
    }

    /**
     * Display the specified resource (API JSON).
     */
    public function show(Paciente $paciente): JsonResponse
    {
       
        $jsonLdData = $paciente->toJsonLd();

        return response()->json([
            'status' => 'success',
            'message' => 'Paciente encontrado con datos semánticos',
            'data' => $paciente,
            'json_ld' => $jsonLdData,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        return response()->json(['message' => 'Actualización de paciente no implementada.'], 501);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        return response()->json(['message' => 'Eliminación de paciente no implementada.'], 501);
    }

    
    // Métodos para la Interfaz Web (Rutas routes/web.php) - Valor Agregado
    
    /**
     * Muestra el listado de pacientes para la interfaz web.
     */
    public function indexWeb(): View
    {
        // Paginación.
        $pacientes = Paciente::paginate(15); 

        return view('pacientes.index', [
            'pacientes' => $pacientes,
        ]);
    }

    /**
     * Muestra el paciente como una página web (HTML), inyectando el JSON-LD.
     */
    public function showWeb(Paciente $paciente): View
    {
        // 1. Generar el objeto semántico JSON-LD
        $jsonLdData = $paciente->toJsonLd();

        // 2. Devolver la vista Blade
        return view('pacientes.show', [
            'paciente' => $paciente,
            'jsonLd' => $jsonLdData, // Esto se inyecta en la etiqueta <script type="application/ld+json">
        ]);
    }
}
