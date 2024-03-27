<div class="row">
    @if (session('rol_id')<3)
        <div class="col-5 col-md-2 form-group">
            <label class="requerido" for="config_grupo_empresas_id">Grupo Empresarial</label>
            <select id="config_grupo_empresas_id" class="form-control form-control-sm" data_url="{{route('grupo_empresas.getEmpresas')}}" required>
                <option value="">Elija grupo empresarial</option>
                @foreach ($grupos as $grupo)
                    <option value="{{ $grupo->id }}" {{isset($cargo_edit)? ($cargo_edit->area->empresa->config_grupo_empresas_id==$grupo->id? 'selected':''):''}}>
                        {{ $grupo->nombres }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-5 col-md-2 form-group {{isset($cargo_edit)==null?'d-none':''}}" id="caja_empresas">
            <label class="requerido" for="config_empresa_id">Empresa</label>
            <select id="config_empresa_id" class="form-control form-control-sm" data_url="{{route('area.getAreas')}}" required>
                @if (isset($cargo_edit))
                    <option value="">Elija empresa</option>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}" {{$cargo_edit->area->config_empresa_id==$empresa->id? 'selected':''}}>
                            {{ $empresa->nombres }}
                        </option>
                    @endforeach
                @else
                    <option value="">Elija grupo</option>
                @endif
            </select>
        </div>
        <div class="col-5 col-md-2 form-group {{isset($cargo_edit)==null?'d-none':''}}" id="caja_areas">
            <label for="empresa_area_id">Área</label>
            <select id="empresa_area_id" class="form-control form-control-sm" name="empresa_area_id">
                <option value="">Elija área</option>
                @if (isset($cargo_edit))
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{isset($cargo_edit)? ($cargo_edit->empresa_area_id==$area->id? 'selected':''):''}}>
                            {{ $area->area }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    @else
        <input type="hidden" name="config_empresa_id" value="{{$config_empresa_id}}">
        <div class="col-5 col-md-2 form-group {{isset($area_edit)==null?'d-none':''}}" id="caja_areas">
            <label for="empresa_area_id">Área Superior</label>
            <select id="empresa_area_id" class="form-control form-control-sm" name="empresa_area_id">
                <option value="">Elija área</option>
                @if (isset($area_edit))
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{isset($area_edit)? ($area_edit->empresa_area_id==$area->id? 'selected':''):''}}>
                            {{ $area->area }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    @endif
    <div class="col-7 col-md-2 form-group {{isset($cargo_edit)==null?'d-none':''}}" id="caja_cargo_nuevo">
        <label class="requerido" for="cargo">Nombre del Cargo</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('cargo', $cargo_edit->cargo ?? '') }}" name="cargo" id="cargo" required>
    </div>
</div>
