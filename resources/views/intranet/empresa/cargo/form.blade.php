<div class="row">
    @if (session('rol_id')<3)
        <div class="col-5 col-md-2 form-group">
            <label class="requerido" for="config_empresa_id">Empresa</label>
            <select id="config_empresa_id" class="form-control form-control-sm" name="config_empresa_id" data_url="{{route('area.getAreas')}}" required>
                <option value="">Elija empresa</option>
                @foreach ($empresas as $empresa)
                    <option value="{{ $empresa->id }}" {{isset($area_edit)? ($area_edit->config_empresa_id==$empresa->id? 'selected':''):''}}>
                        {{ $empresa->nombres }}
                    </option>
                @endforeach
            </select>
        </div>
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
    <div class="col-7 col-md-2 form-group {{isset($area_edit)==null?'d-none':''}}" id="caja_area_nueva">
        <label class="requerido" for="area">Nombre del Área</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('area', $area_edit->area ?? '') }}" name="area" id="area" required>
    </div>
</div>
