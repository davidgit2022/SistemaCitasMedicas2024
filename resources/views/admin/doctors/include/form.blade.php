@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@csrf
{{-- Name --}}

<div class="form-group">
    <label for="name">Nombre del doctor:</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Nombre del doctor"
        value="{{ old('name', $doctor->name) }}" required>
    @error('name')
        <span class="text-danger">
            {{ $message }}
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
            {{ $message }}
        </span>
    @enderror
</div>

{{-- Specialties --}}
<div class="form-group">
    <label for="exampleFormControlSelect2">Especialidad:</label>
    <select class="form-control js-example-basic-multiple" name="specialties[]" multiple="multiple" id="specialties"
        required>
        @foreach ($specialties as $specialty)
            <option value="{{ $specialty->id }}"
                {{ in_array($specialty->id, old('specialties', [])) ? 'selected' : '' }}>
                {{ $specialty->FormatName }}</option>
        @endforeach
    </select>
    @error('specialties')
        <span class="text-danger">
            <span>*{{ $message }}</span>
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
            {{ $message }}
        </span>
    @enderror
</div>
@if ($doctor->id == 0)
    {{-- Password --}}
<div class="form-group">
    <label for="password">Contraseña:</label>
    <input type="password" class="form-control" name="password" id="password" required>

    @error('password')
        <span class="text-danger">
            <span>*{{ $message }}</span>
        </span>
    @enderror
</div>

{{-- Confirmation Password --}}
<div class="form-group">
    <label for="password_confirmation">Confirmar contraseña:</label>
    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>

    @error('password_confirmation')
        <span class="text-danger">
            <span>*{{ $message }}</span>
        </span>
    @enderror
</div>

@endif


{{-- DNI --}}

<div class="form-group">
    <label for="dni">Cedula:</label>
    <input type="number" id="dni" name="dni" class="form-control" placeholder="Cedula"
        value="{{ old('dni', $doctor->dni) }}" required>
    @error('dni')
        <span class="text-danger">
            {{ $message }}
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
            {{ $message }}
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
            {{ $message }}
        </span>
    @enderror
</div>


<button type="submit" class="btn btn-sm btn-primary">{{ $doctor->id > 0 ? 'Actualizar' : 'Guardar' }}</button>



@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(() => {});
        $('#specialties').val(@json($idsSpecialties));
    </script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                theme: "classic"
            });
        });
    </script>
@endpush
