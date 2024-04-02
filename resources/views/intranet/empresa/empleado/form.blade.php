<div class="row">
    @if (session('rol_id')<3)
        <div class="col-5 col-md-3 form-group">
            <label class="requerido" for="config_grupo_empresas_id">Grupo Empresarial</label>
            <select id="config_grupo_empresas_id" class="form-control form-control-sm" data_url="{{route('grupo_empresas.getEmpresas')}}" required>
                <option value="">Elija grupo empresarial</option>
                @foreach ($grupos as $grupo)
                    <option value="{{ $grupo->id }}" {{isset($usuario_edit)? ($usuario_edit->empleado->cargo->area->empresa->config_grupo_empresas_id==$grupo->id? 'selected':''):''}}>
                        {{ $grupo->nombres }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-5 col-md-3 form-group {{isset($usuario_edit)==null?'d-none':''}}" id="caja_empresas">
            <label class="requerido" for="config_empresa_id">Empresa</label>
            <select id="config_empresa_id" class="form-control form-control-sm" data_url="{{route('area.getAreas')}}" name="config_empresa_id" required>
                @if (isset($usuario_edit))
                    <option value="">Elija empresa</option>
                    @foreach ($usuario_edit->empleado->cargo->area->empresa->grupo->empresas as $empresa)
                        <option value="{{ $empresa->id }}" {{$usuario_edit->empleado->cargo->area->config_empresa_id==$empresa->id? 'selected':''}}>
                            {{ $empresa->nombres }}
                        </option>
                    @endforeach
                @else
                    <option value="">Elija grupo</option>
                @endif
            </select>
        </div>
        <div class="col-5 col-md-3 form-group {{isset($usuario_edit)==null?'d-none':''}}" id="caja_areas">
            <label for="empresa_area_id">Área</label>
            <select id="empresa_area_id" class="form-control form-control-sm" name="empresa_area_id" data_url="{{route('empleado.getCargos')}}" required>
                <option value="">Elija área</option>
                @if (isset($usuario_edit))
                    @foreach ($usuario_edit->empleado->cargo->area->empresa->areas as $area)
                        <option value="{{ $area->id }}" {{isset($usuario_edit)? ($usuario_edit->empleado->cargo->empresa_area_id==$area->id? 'selected':''):''}}>
                            {{ $area->area }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-5 col-md-3 form-group {{isset($usuario_edit)==null?'d-none':''}}" id="caja_cargos">
            <label for="empresa_cargo_id">Cargo</label>
            <select id="empresa_cargo_id" class="form-control form-control-sm" name="empresa_cargo_id" required>
                <option value="">Elija Cargo</option>
                @if (isset($usuario_edit))
                    @foreach ($usuario_edit->empleado->cargo->area->cargos as $cargo)
                        <option value="{{ $cargo->id }}" {{isset($usuario_edit)? ($usuario_edit->empleado->empresa_cargo_id==$cargo->id? 'selected':''):''}}>
                            {{ $cargo->cargo }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    @else

    @endif
    <div class="col-12 {{isset($usuario_edit)==null?'d-none':''}}" id="caja_usuario_nuevo">
        <div class="row d-flex justify-content-between">
            <div class="col-12 col-md-2 form-group">
                <label for="config_tipo_documento_id">Tipo de identificación</label>
                <select id="config_tipo_documento_id" class="form-control form-control-sm" name="config_tipo_documento_id" required>
                    <option value="">Elija tipo</option>
                    @foreach ($tiposdocu as $tipoDocu)
                        <option value="{{ $tipoDocu->id }}" {{isset($empresa)?$empresa->config_tipo_documento_id == $tipoDocu->id?'selected':'':''}}>
                            {{ $tipoDocu->abreb_id }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="identificacion" class="control-label requerido">Identificación</label>
                    <input type="text" name="identificacion" id="identificacion" class="form-control form-control-sm" value="{{old('identificacion', $usuario_edit->identificacion ?? '')}}" required/>
                </div>
            </div>
            <div class="col-7 col-md-3 form-group">
                <label class="requerido" for="nombres">Nombres del Usuario</label>
                <input type="text" class="form-control form-control-sm" value="{{ old('nombres', $usuario_edit->nombres ?? '') }}" name="nombres" id="nombres" required>
            </div>
            <div class="col-7 col-md-3 form-group">
                <label class="requerido" for="apellidos">Apellidos del Usuario</label>
                <input type="text" class="form-control form-control-sm" value="{{ old('apellidos', $usuario_edit->apellidos ?? '') }}" name="apellidos" id="apellidos" required>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="email" class="control-label requerido">Correo Eletrónico</label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm" value="{{old('email', $usuario_edit->email ?? '')}}" required/>
                </div>
            </div>
            <div class="col-7 col-md-2 form-group">
                <label class="requerido" for="telefono">Teléfono</label>
                <input type="text" class="form-control form-control-sm" value="{{ old('telefono', $usuario_edit->telefono ?? '') }}" name="telefono" id="telefono" required>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="direccion" class="control-label requerido">Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" value="{{old('direccion', $usuario_edit->direccion ?? '')}}" required/>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-evenly">
            <div class="col-10 col-md-2 form-group">
                <label for="foto" class="requerido">Fotografía</label>
                <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto del usuario"
                    accept="image/png,image/jpeg" onchange="mostrar()">
                <small id="helpId" class="form-text text-muted">Fotografía</small>
            </div>
            <div class="col-12">
                <div class="row d-flex justify-content-evenly">
                    <div class="col-10 col-md-2">
                        <img class="img-fluid fotoUsuario" id="fotoUsuario"
                            src="{{ isset($usuario_edit) ?($usuario_edit->foto!=null?asset('/imagenes/usuarios/'.$usuario_edit->foto) : asset('/imagenes/usuarios/usuario-inicial.jpg')) : asset('/imagenes/usuarios/usuario-inicial.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
