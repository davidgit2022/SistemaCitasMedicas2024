@csrf
<div class="form-group">
    <label for="name">Nombre de la especialidad:</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Nombre de la especialidad"
        value="{{ old('name', $specialty->name) }}" required>
    @error('name')
        <span class="text-danger">
            {{ $message}}
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="description">Descripción:</label>
    <input type="text" id="description" name="description" class="form-control" placeholder="Descripción"
        value="{{ old('description', $specialty->description) }}">
</div>

<button type="submit" class="btn btn-sm btn-primary">{{ $specialty->id > 0 ? 'Actualizar' : 'Guardar'}}</button>
