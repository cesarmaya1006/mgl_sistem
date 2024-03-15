@extends("layouts.app")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')

@endsection
<!-- Pagina CSS -->
@section('estilosHojas')

@endsection
<!-- ************************************************************* -->
@section('titulo_panel')
<i class="fa fa-cogs ml-4" aria-hidden="true"></i> Configuración - Menu/Roles
@endsection
<!-- ************************************************************* -->
@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <h4 class="card-title">
                                <strong>Administración de permisos Menu - Roles</strong>
                            </h4>
                        </div>
                        <div class="col-12 mb-4">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        @include('includes.mensaje')
                        @include('includes.error-form')
                    </div>
                    <div class="col-12">
                        @csrf
                        <table class="table table-striped table-hover table-responsive" id="tabla-data">
                            <thead>
                                <tr>
                                    <th>Menú</th>
                                    @foreach ($rols as $id => $nombre)
                                        <th class="text-center" style="width:1px;white-space:nowrap; max-width: 200px;">
                                            {{ utf8_encode(ucwords(strtolower(utf8_decode($nombre)))) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $key => $menu)
                                    @if ($menu['config_menu_id'] != 0)
                                        @break
                                    @endif
                                <tr>
                                    <td class="font-weight-bold" style="width:1px;white-space:nowrap;">
                                        <i class="fa fa-arrows-alt"></i>
                                            {{ utf8_encode(ucfirst(strtolower(utf8_decode($menu['nombre'])))) }}
                                    </td>
                                    @foreach ($rols as $id => $nombre)
                                        <td class="text-center">
                                            <input type="checkbox" class="menu_rol" name="menu_rol[]"
                                                data-menuid={{ $menu['id'] }} value="{{ $id }}"
                                                {{ in_array($id, array_column($menusRols[$menu['id']], 'id')) ? 'checked' : '' }}>
                                        </td>
                                    @endforeach
                                </tr>
                                @foreach ($menu['submenu'] as $key => $hijo)
                                    <tr>
                                        <td class="pl-20  pl-4" style="width:1px;white-space:nowrap;"><i class="fa fa-arrow-right"></i>
                                            {{ utf8_encode(ucfirst(strtolower(utf8_decode($hijo['nombre'])))) }}</td>
                                        @foreach ($rols as $id => $nombre)
                                            <td class="text-center">
                                                <input type="checkbox" class="menu_rol" name="menu_rol[]"
                                                    data-menuid={{ $hijo['id'] }} value="{{ $id }}"
                                                    {{ in_array($id, array_column($menusRols[$hijo['id']], 'id')) ? 'checked' : '' }}>
                                            </td>
                                        @endforeach
                                    </tr>
                                    @foreach ($hijo['submenu'] as $key => $hijo2)
                                        <tr>
                                            <td class="pl-30" style="width:1px;white-space:nowrap;"><i
                                                    class="fa fa-arrow-right"></i>
                                                {{ utf8_encode(ucfirst(strtolower(utf8_decode($hijo2['nombre'])))) }}</td>
                                            @foreach ($rols as $id => $nombre)
                                                <td class="text-center">
                                                    <input type="checkbox" class="menu_rol" name="menu_rol[]"
                                                        data-menuid={{ $hijo2['id'] }} value="{{ $id }}"
                                                        {{ in_array($id, array_column($menusRols[$hijo2['id']], 'id')) ? 'checked' : '' }}>
                                                </td>
                                            @endforeach
                                        </tr>
                                        @foreach ($hijo2['submenu'] as $key => $hijo3)
                                            <tr>
                                                <td class="pl-40" style="width:1px;white-space:nowrap;"><i
                                                        class="fa fa-arrow-right"></i>
                                                    {{ utf8_encode(ucfirst(strtolower(utf8_decode($hijo3['nombre'])))) }}
                                                </td>
                                                @foreach ($rols as $id => $nombre)
                                                    <td class="text-center">
                                                        <input type="checkbox" class="menu_rol" name="menu_rol[]"
                                                            data-menuid={{ $hijo3['id'] }} value="{{ $id }}"
                                                            {{ in_array($id, array_column($menusRols[$hijo3['id']], 'id')) ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
<script src="{{ asset('js/intranet/configuracion/menu_rol/menu_rol.js') }}"></script>
@endsection
<!-- ************************************************************* -->
