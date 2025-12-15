@extends('layout.app')

@section('title', 'Médicos')

@section('header-title', 'Web Semántica - Médicos')
@section('header-subtitle', 'Listado interactivo consumiendo la API REST con JSON-LD')

@section('content')
    <h3 style="color: #28a745; margin-top: 0;">Listado de Médicos (cargado desde /api/v1/medicos)</h3>

    <table id="tabla-medicos" class="table-api">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Especialidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr class="loading">
                <td colspan="5">Cargando datos desde la API...</td>
            </tr>
        </tbody>
    </table>




