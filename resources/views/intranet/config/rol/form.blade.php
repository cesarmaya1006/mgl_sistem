<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label class="requerido" for="nombre">Rol</label>
            <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId"
                value="{{ old('nombre', $rol->nombre ?? '') }}" placeholder="Nombre de rol" required>
        </div>
    </div>
</div>
