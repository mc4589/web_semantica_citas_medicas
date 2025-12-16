@extends('layout.app')

@section('title', 'Pacientes')

@section('header-title', 'Web Semántica - Pacientes')
@section('header-subtitle', 'Listado interactivo consumiendo la API REST con JSON-LD')

@section('content')
    <h3 style="color: #28a745; margin-top: 0;">Listado de Pacientes (cargado desde /api/v1/pacientes)</h3>

    <table id="tabla-pacientes" class="table-api">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr class="loading">
                <td colspan="5">Cargando datos desde la API...</td>
            </tr>
        </tbody>
    </table>

