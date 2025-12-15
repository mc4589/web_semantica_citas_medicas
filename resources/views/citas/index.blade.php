@extends('layout.app')

@section('title', 'Citas Médicas')

@section('header-title', 'Web Semántica - Citas Médicas')
@section('header-subtitle', 'Listado interactivo consumiendo la API REST con JSON-LD')

@section('content')
    <h3 style="color: #28a745; margin-top: 0;">Listado de Citas (cargado desde /api/v1/citas)</h3>

    <table id="tabla-citas" class="table-api">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha y Hora</th>
                    <th>Médico</th>
                    <th>Paciente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr class="loading">
                    <td colspan="5">Cargando datos desde la API...</td>
                </tr>
            </tbody>
    </table>

