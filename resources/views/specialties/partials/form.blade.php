@csrf
<div class="form-group">
    <label for="name">Nombre de la especialidad:</label>
    <input type="text" name="name" class="form-control" placeholder="Nombre de la especialidad"
        value="{{ old('name') }}" required>
    @error('name')
        <span class="text-danger">
            {{ $message}}
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="description">Descripción:</label>
    <input type="text" name="description" class="form-control" placeholder="Descripción"
        value="{{ old('description') }}">
</div>
<button type="submit" class="btn btn-sm btn-primary">Guardar</button>
