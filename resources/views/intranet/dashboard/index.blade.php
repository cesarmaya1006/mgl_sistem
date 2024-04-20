@extends("layouts.app")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')

@endsection
<!-- Pagina CSS -->
@section('estilosHojas')
<link rel="stylesheet" href="{{ asset('css/intranet/dashboard/index.css') }}">
@endsection
<!-- ************************************************************* -->
@section('titulo_panel')
Dashboard
@endsection
<!-- ************************************************************* -->
@section('contenido')
<div class="row">
    <div class="col-12">
        <h1>Pagina Principal</h1>
        <br>
        <br>
        <h3>Rol: {{session()->get('rol.nombre')}}</h3>
        <br>
        <br>
        {{session('rol.nombre')}}
        <br>
        <br>
        {{session('id_usuario')}}
        <br>
        {{session('config_empresa_id')}}
        <br>
        {{session('config_tipo_documento_id')}}
        <br>
        {{session('identificacion')}}
        <br>
        {{session('nombres')}}
        <br>
        {{session('apellidos')}}
        <br>
        {{session('email')}}
        <br>
        {{session('telefono')}}
        <br>
        {{session('direccion')}}
        <br>
        {{session('estado')}}
        <br>
        {{session('foto')}}
        <br>
        {{session('empresa_cargo_id')}}
        <br>
        {{session('mgl')}}
        <br>
        <hr>
        <h3>Apariencia:</h3>
        <br>
    {{session('apariencia')}}
    <hr>
    {{session('cant_notificaciones')}}
    <hr>
    <p>cantidad de notificaciones: {{session('cant_notificaciones')}}</p>

    </div>
</div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')

@endsection
<!-- ************************************************************* -->
