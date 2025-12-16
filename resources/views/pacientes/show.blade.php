@extends('layout.app')

@section('title', 'Detalle de Paciente')

@section('header-title', 'Web Semántica - Detalle de Paciente')
@section('header-subtitle', 'Datos y JSON-LD cargados dinámicamente desde la API')

@section('content')
    <!-- JSON-LD inyectado para SEO -->
    <script type="application/ld+json">
        {!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    <h3 style="color: #28a745; margin-top: 0;">Información cargada desde la API</h3>
