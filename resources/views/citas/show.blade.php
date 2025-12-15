@extends('layout.app')

@section('title', 'Detalle de Cita Médica')

@section('header-title', 'Web Semántica - Detalle de Cita')
@section('header-subtitle', 'Datos y JSON-LD cargados dinámicamente desde la API')

@section('content')
    <!-- JSON-LD inyectado para SEO -->
    <script type="application/ld+json">
        {!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

     <h3 style="color: #28a745; margin-top: 0;">Información cargada desde la API</h3>

    <div class="detalle-api">
        <h4>Detalles de la Cita</h4>
        <p><strong>ID:</strong> <span data-campo="id">cargando...</span></p>
        <p><strong>Fecha y Hora:</strong> <span data-campo="fecha">cargando...</span> a las <span data-campo="hora">cargando...</span></p>
        <p><strong>Paciente:</strong> <span data-campo="paciente.nombre">cargando...</span></p>
        <p><strong>Médico:</strong> <span data-campo="medico.nombre">cargando...</span> 
           (<span data-campo="medico.especialidad.nombre">cargando...</span>)</p>
        <p><strong>Descripción:</strong> <span data-campo="descripcion">-</span></p>
    </div>




