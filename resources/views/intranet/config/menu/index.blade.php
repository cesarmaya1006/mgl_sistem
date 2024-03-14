@extends("layouts.app")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')

@endsection
<!-- Pagina CSS -->
@section('estilosHojas')
<link rel="stylesheet" href="{{ asset('css/intranet/menu/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/intranet/menu/menu_nestable.css') }}">
@endsection
<!-- ************************************************************* -->
@section('titulo_panel')
<i class="fa fa-cogs ml-4" aria-hidden="true"></i> Configuración - Menu
@endsection
<!-- ************************************************************* -->
@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h4 class="card-title">
                    <strong>Listado de Menus</strong>
                </h4>
            </div>
            <div class="card-body">
                @csrf
                <div class="cf nestable-lists">
                    <div class="dd" id="nestable">
                        <ol class="dd-list" id="dd_list99" data-url="{{ route('menu.ordenar') }}">
                            @foreach ($menus as $key => $item)
                                @if ($item['config_menu_id'] != 0)
                                    @break
                                @endif
                                @include('intranet.config.menu.menu-item')
                            @endforeach
                        </ol>
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
<script src="{{ asset('js/intranet/configuracion/menu/jquery.nestable.js') }}"></script>
<script src="{{ asset('js/intranet/configuracion/menu/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
