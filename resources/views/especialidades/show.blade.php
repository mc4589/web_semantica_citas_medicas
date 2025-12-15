@extends('layout.app')

@section('title', 'Detalle de Especialidad')

@section('header-title', 'Web Semántica - Detalle de Especialidad')
@section('header-subtitle', 'Datos y JSON-LD cargados dinámicamente desde la API')

@section('content')
    <!-- JSON-LD inyectado para SEO -->
    <script type="application/ld+json">
        {!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    <h3 style="color: #28a745; margin-top: 0;">Información cargada desde la API</h3>
    
    <div class="detalle-api">
            <h4>Detalles de la Especialidad</h4>
            <p><strong>ID:</strong> <span data-campo="id">cargando...</span></p>
            <p><strong>Nombre:</strong> <span data-campo="nombre">cargando...</span></p>
    </div>

    <div id="jsonld-api-detalle" class="jsonld-container">
        <h3>JSON-LD recibido desde la API (endpoint show)</h3>
        <p>Cargando JSON-LD semántico único...</p>
    </div>
@endsection


