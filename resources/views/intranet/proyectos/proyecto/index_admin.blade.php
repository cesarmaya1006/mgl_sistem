@foreach ($grupos as $grupo)
<div class="row">
    <div class="col-12">
        <h3>{{$grupo->nombres}}</h3>
    </div>
    @foreach ($grupo->empresas as $empresa)
    <div class="col-12 col-md-3">
        <div class="card card-widget widget-user-2 card-proyectos">
            <div class="widget-user-header bg-info">
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="{{asset('imagenes/sistema/'.$empresa->logo)}}" alt="{{$empresa->nombres}}">
                </div>
                <h3 class="widget-user-username">{{$empresa->nombres}}</h3>
                <h5 class="widget-user-desc">Email: {{$empresa->email}}</h5>
                <h5 class="widget-user-desc">Teléfono: {{$empresa->telefono}}</h5>
            </div>
            <div class="card-footer p-0">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a
                            class="nav-link {{ $empresa->proyectos->count() > 0 ? 'link_item_card':''}}"
                            data_id = "{{$empresa->id}}"
                            data_url = "{{route('proyecto.getproyectos', ['estado' => 'todos', 'config_empresa_id' => $empresa->id] )}}">
                            Total Proyectos <span class="float-right badge bg-dark">{{$empresa->proyectos->count()}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link {{ $empresa->proyectos->where('estado','activo')->count() > 0 ? 'link_item_card':''}}"
                            data_id = "{{$empresa->id}}"
                            data_url = "{{route('proyecto.getproyectos', ['estado' => 'activo', 'config_empresa_id' => $empresa->id] )}}">
                            Proyectos En curso <span class="float-right badge bg-success">{{$empresa->proyectos->where('estado','activo')->count()}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link {{ $empresa->proyectos->where('estado','extendido')->count() > 0 ? 'link_item_card':''}}"
                            data_id = "{{$empresa->id}}"
                            data_url = "{{route('proyecto.getproyectos', ['estado' => 'extendido', 'config_empresa_id' => $empresa->id] )}}">
                            Proyectos Extendidos <span class="float-right badge bg-danger">{{$empresa->proyectos->where('estado','extendido')->count()}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link {{ $empresa->proyectos->where('estado','cerrado')->count() > 0 ? 'link_item_card':''}}"
                            data_id = "{{$empresa->id}}"
                            data_url = "{{route('proyecto.getproyectos', ['estado' => 'cerrado', 'config_empresa_id' => $empresa->id] )}}">
                            Proyectos Cerrados <span class="float-right badge bg-secondary">{{$empresa->proyectos->where('estado','cerrado')->count()}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endforeach
