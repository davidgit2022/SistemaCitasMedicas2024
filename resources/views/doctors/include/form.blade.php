@csrf
{{-- Name --}}

<div class="form-group">
    <label for="name">Nombre del doctor:</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Nombre del doctor"
        value="{{ old('name', $doctor->name) }}" required>
    @error('name')
        <span class="text-danger">
            {{ $message}}
        </span>
    @enderror
</div>

{{-- LastName --}}

<div class="form-group">
    <label for="lastName">Apellido del doctor:</label>
    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Apellido del doctor"
        value="{{ old('lastName', $doctor->last_name) }}" required>
    @error('lastName')
        <span class="text-danger">
            {{ $message}}
        </span>
    @enderror
</div>

{{-- Email --}}

<div class="form-group">
    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Correo electrónico"
        value="{{ old('email', $doctor->email) }}" required>
    @error('email')
        <span class="text-danger">
            {{ $message}}
        </span>
    @enderror
</div>

{{-- DNI --}}

<div class="form-group">
    <label for="dni">Cedula:</label>
    <input type="number" id="dni" name="dni" class="form-control" placeholder="Cedula"
        value="{{ old('dni', $doctor->dni) }}" required>
    @error('dni')
        <span class="text-danger">
            {{ $message}}
        </span>
    @enderror
</div>

{{-- Address --}}

<div class="form-group">
    <label for="address">Dirección:</label>
    <input type="text" id="address" name="address" class="form-control" placeholder="Dirección"
        value="{{ old('address', $doctor->address) }}" required>
    @error('address')
        <span class="text-danger">
            {{ $message}}
        </span>
    @enderror
</div>

{{-- Mobil --}}

<div class="form-group">
    <label for="mobile">Celular:</label>
    <input type="number" id="mobile" name="mobile" class="form-control" placeholder="Cedula"
        value="{{ old('mobile', $doctor->mobile) }}" required>
    @error('mobile')
        <span class="text-danger">
            {{ $message}}
        </span>
    @enderror
</div>


<button type="submit" class="btn btn-sm btn-primary">{{ $doctor->id > 0 ? 'Actualizar' : 'Guardar'}}</button>
