@extends('layout.app')

@section('title', 'Especialidades')

@section('header-title', 'Web Semántica - Especialidades')
@section('header-subtitle', 'Listado interactivo consumiendo la API REST con JSON-LD')

@section('content')
    <h3 style="color: #28a745; margin-top: 0;">Listado de Especialidades (cargado desde /api/v1/especialidades)</h3>

    <table id="tabla-especialidades" class="table-api">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr class="loading">
                    <td colspan="3">Cargando datos desde la API...</td>
                </tr>
            </tbody>
    </table>

