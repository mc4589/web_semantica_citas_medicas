<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class EspecialidadController extends Controller
{
    
    // Métodos para la API REST (Rutas routes/api.php)
    
    /**
     * Display a listing of the resource (API JSON).
     */
    public function index(): JsonResponse
    {
        $especialidades = Especialidad::paginate(10);
        
        $data = $especialidades->getCollection()->map(function (Especialidad $especialidad) {
            return [
                'especialidad' => $especialidad, 
                'json_ld' => $especialidad->toJsonLd(),
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Lista de especialidades con datos semánticos JSON-LD',
            'data' => $data,
            'pagination' => [
                'total' => $especialidades->total(),
                'per_page' => $especialidades->perPage(),
                'current_page' => $especialidades->currentPage(),
                'last_page' => $especialidades->lastPage(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json(['message' => 'Creación de especialidad no implementada.'], 501);
    }

    /**
     * Display the specified resource (API JSON).
    */
    public function show($id): JsonResponse
    {
        $especialidad = Especialidad::find($id);

        if (!$especialidad) {
            abort(404, 'Especialidad no encontrada');
        }

        $jsonLdData = $especialidad->toJsonLd();

        return response()->json([
            'status' => 'success',
            'message' => 'Especialidad encontrada con datos semánticos',
            'data' => $especialidad,
            'json_ld' => $jsonLdData,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Especialidad $especialidad)
    {
        return response()->json(['message' => 'Actualización de especialidad no implementada.'], 501);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Especialidad $especialidad)
    {
        return response()->json(['message' => 'Eliminación de especialidad no implementada.'], 501);
    }

    
    // Métodos para la Interfaz Web (Rutas routes/web.php) 
   
    /**
     * Muestra el listado de especialidades para la interfaz web.
     */
    public function indexWeb(): View
    {
        $especialidades = Especialidad::paginate(15); 

        return view('especialidades.index', [
            'especialidades' => $especialidades,
        ]);
    }

    /**
     * Muestra la especialidad como una página web (HTML), inyectando el JSON-LD.
    */
    public function showWeb($especialidad): View
    {
        $especialidad = Especialidad::findOrFail($especialidad);

        $jsonLdData = $especialidad->toJsonLd();

        return view('especialidades.show', [
            'especialidad' => $especialidad,
            'jsonLd' => $jsonLdData,
        ]);
    }
}
