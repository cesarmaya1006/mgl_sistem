<div class="row">
    <div class="col-5 col-md-2 form-group">
        <label for="docutipos_id">Tipo de identificación</label>
        <select id="docutipos_id" class="form-control form-control-sm" name="docutipos_id" required>
            <option value="">Elija tipo</option>
            @foreach ($tiposdocu as $tipoDocu)
                <option value="{{ $tipoDocu->id }}">{{ $tipoDocu->abreb_id }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-7 col-md-2 form-group">
        <label for="identificacion">Identificación</label>
        <input type="text" class="form-control form-control-sm" name="identificacion"
            id="identificacion" required>
    </div>
    <div class="col-12 col-md-4 form-group">
        <label for="nombre">Empresa</label>
        <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" required>
    </div>
    <div class="col-12 col-md-4 form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" class="form-control form-control-sm" name="email" id="email" required>
    </div>
    <div class="col-12 col-md-2 form-group">
        <label for="telefono">Teléfono</label>
        <input type="tel" class="form-control form-control-sm" name="telefono" id="telefono" required>
    </div>
    <div class="col-12 col-md-4 form-group">
        <label for="contacto">Contacto</label>
        <input type="text" class="form-control form-control-sm" name="contacto" id="contacto" required>
    </div>
    <div class="col-12 col-md-4 form-group">
        <label for="cargo">Cargo contacto</label>
        <input type="text" class="form-control form-control-sm" name="cargo" id="cargo" required>
    </div>
</div>
