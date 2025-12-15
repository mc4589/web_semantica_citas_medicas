@extends('layout.app')

@section('title', 'Detalle de Cita Médica')

@section('header-title', 'Web Semántica - Detalle de Cita')
@section('header-subtitle', 'Datos y JSON-LD cargados dinámicamente desde la API')

@section('content')
    <!-- JSON-LD inyectado para SEO -->
    <script type="application/ld+json">
        {!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>


