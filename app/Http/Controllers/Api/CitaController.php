<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; 
use Illuminate\View\View; 

class CitaController extends Controller
{
    
    // Métodos para la API REST (Rutas routes/api.php)
    
    /**
     * Display a listing of the resource (API JSON).
     */
    public function index(): JsonResponse
    {
        $citas = Cita::with(['medico.especialidad', 'paciente'])->paginate(15); 

        $data = $citas->getCollection()->map(function (Cita $cita) {
            return [
                'cita' => $cita, 
                'json_ld' => $cita->toJsonLd(),
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Lista de citas con datos semánticos JSON-LD',
            'data' => $data,
            'pagination' => [
                'total' => $citas->total(),
                'per_page' => $citas->perPage(),
                'current_page' => $citas->currentPage(),
                'last_page' => $citas->lastPage(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json(['message' => 'Creación de cita no implementada.'], 501);
    }

    /**
     * Display the specified resource (API JSON).
     */
    public function show(Cita $cita): JsonResponse
    {
        $cita->loadMissing(['medico.especialidad', 'paciente']); 
        $jsonLdData = $cita->toJsonLd();

        return response()->json([
            'status' => 'success',
            'message' => 'Cita encontrada con datos semánticos',
            'data' => $cita,
            'json_ld' => $jsonLdData,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        return response()->json(['message' => 'Actualización de cita no implementada.'], 501);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        return response()->json(['message' => 'Eliminación de cita no implementada.'], 501);
    }
    
   
    // Métodos para la Interfaz Web (Rutas routes/web.php) 
    
    /**
     * Muestra el listado de citas para la interfaz web.
     */
    public function indexWeb(): View
    {
        // Cargar todas las relaciones necesarias para mostrar la tabla
        $citas = Cita::with(['medico', 'paciente'])->paginate(15); 

        return view('citas.index', [
            'citas' => $citas,
        ]);
    }
    
    /**
     * Muestra la cita como una página web (HTML), inyectando el JSON-LD.
     */
    public function showWeb(Cita $cita): View
    {
        // 1. Cargar las relaciones necesarias para el JSON-LD
        $cita->loadMissing(['medico.especialidad', 'paciente']); 

        // 2. Generar el objeto semántico JSON-LD
        $jsonLdData = $cita->toJsonLd();

        // 3. Devolver la vista Blade
        return view('citas.show', [
            'cita' => $cita,
            'jsonLd' => $jsonLdData, // Esta línea sirve para inyectar en la etiqueta <script type="application/ld+json">
        ]);
    }
}
