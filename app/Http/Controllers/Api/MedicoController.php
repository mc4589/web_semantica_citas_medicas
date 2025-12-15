<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; // Para las respuestas JSON de la API
use Illuminate\View\View;         // Para las respuestas de vista web

class MedicoController extends Controller
{
   
    // Métodos para la API REST (Rutas routes/api.php)
   
    /**
     * Display a listing of the resource (API JSON).
     */
    public function index(): JsonResponse
    {
        $medicos = Medico::with('especialidad')->paginate(15); 

        $data = $medicos->getCollection()->map(function (Medico $medico) {
            return [
                'medico' => $medico,
                'json_ld' => $medico->toJsonLd(),
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Lista de médicos con datos semánticos JSON-LD',
            'data' => $data,
            'pagination' => [
                'total' => $medicos->total(),
                'per_page' => $medicos->perPage(),
                'current_page' => $medicos->currentPage(),
                'last_page' => $medicos->lastPage(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json(['message' => 'Creación de médico no implementada.'], 501);
    }

    /**
     * Display the specified resource (API JSON).
     */
    public function show(Medico $medico): JsonResponse
    {
        $medico->loadMissing('especialidad'); 
        $jsonLdData = $medico->toJsonLd();

        return response()->json([
            'status' => 'success',
            'message' => 'Médico encontrado con datos semánticos',
            'data' => $medico,
            'json_ld' => $jsonLdData,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medico $medico)
    {
        return response()->json(['message' => 'Actualización de médico no implementada.'], 501);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medico $medico)
    {
        return response()->json(['message' => 'Eliminación de médico no implementada.'], 501);
    }

    
    // Métodos para la Interfaz Web (Rutas routes/web.php) 
   
    /**
     * Muestra el listado de médicos para la interfaz web.
     */
    public function indexWeb(): View
    {
        // Cargar la relación 'especialidad' para mostrar en la tabla
        $medicos = Medico::with('especialidad')->paginate(15); 

        return view('medicos.index', [
            'medicos' => $medicos,
        ]);
    }

    /**
     * Muestra el médico como una página web (HTML), inyectando el JSON-LD.
     */
    public function showWeb(Medico $medico): View
    {
        // 1. Cargar las relaciones necesarias para el JSON-LD
        $medico->loadMissing('especialidad'); 

        // 2. Generar el objeto semántico JSON-LD
        $jsonLdData = $medico->toJsonLd();

        // 3. Devolver la vista Blade
        return view('medicos.show', [
            'medico' => $medico,
            'jsonLd' => $jsonLdData, // Esto se inyecta en la etiqueta <script type="application/ld+json">
        ]);
    }
}
