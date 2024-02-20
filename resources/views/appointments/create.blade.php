@extends('layouts.theme.app')

@section('title', 'Registrar nueva cita')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Registar nueva cita</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ route('patients.index') }}" class="btn btn-sm btn-success">Regresar</a>
                    <i class="fas fa-chevron-left"></i>
                </div>
            </div>
        </div>
        <div class="card-body">

            @include('doctors.partials.error-form')
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                {{-- Specialties --}}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="specialty">Especialidad:</label>
                        <select name="specialty_id" id="specialty" class="form-control">
                            <option value="">Seleccionar especialidad</option>
                            @foreach ($specialties as $specialty)
                                <option value="{{ $specialty->id }}" @if (old('specialty_id') == $specialty->id) selected @endif>
                                    {{ $specialty->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="doctor">Medico:</label>
                        <select name="doctor_id" id="doctor" class="form-control" required>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" @if (old('doctor_id') == $doctor->id) selected @endif>
                                    {{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Date --}}
                <div class="form-group">
                    <label for="date">Fecha:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" name="scheduled_date" id="date"
                            placeholder="Seleccionar fecha" type="date"
                            value="{{ old('scheduled_date'), date('Y-m-d') }}" data-date-format="yyyy-mm-dd"
                            data-date-start-date="{{ date('Y-m-d') }}" data-date-end-date="+30d">
                    </div>
                </div>

                {{-- Hours Atention --}}
                <div class="form-group">
                    <label for="hours">Hora de atención:</label>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h4 class="m-3" id="titleMorning"></h4>
                                <div id="hoursMorning">
                                    @if ($intervals)
                                        <h4 class="m-3">En la mañana</h4>
                                        @foreach ($intervals['morning'] as $key => $interval)
                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" id="intervalMorning{{ $key }}"
                                                    name="scheduled_time" value="{{ $interval['start'] }}"
                                                    class="custom-control-input" required>
                                                <label class="custom-control-label"
                                                    for="intervalMorning{{ $key }}">{{ $interval['start'] }} -
                                                    {{ $interval['end'] }}</label>
                                            </div>
                                        @endforeach
                                    @else
                                        <mark>
                                            <small class="text-warning display-5">Selecciona un médico y una fecha, para ver
                                                las horas:</small>
                                        </mark>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="m-3" id="titleAfternoon"></h4>
                                <div id="hoursAfternoon">
                                    @if ($intervals)
                                        <h4 class="m-3">En la tarde</h4>
                                        @foreach ($intervals['afternoon'] as $key => $interval)
                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" id="intervalAfternoon{{ $key }}"
                                                    name="scheduled_time" value="{{ $interval['start'] }}"
                                                    class="custom-control-input" required>
                                                <label class="custom-control-label"
                                                    for="intervalAfternoon{{ $key }}">{{ $interval['start'] }} -
                                                    {{ $interval['end'] }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tipo de consulta:</label>
                    <div class="custom-control custom-radio mt-3 mb-3">
                        <input type="radio" id="type1" name="type" class="custom-control-input"
                            @if (old('type') == 'Consulta') checked @endif value="Consulta">
                        <label class="custom-control-label" for="type1">Consulta</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="type2" name="type" class="custom-control-input"
                            @if (old('type2') == 'Examen') checked @endif value="Examen">
                        <label class="custom-control-label" for="type2">Examen</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="type3" name="type" class="custom-control-input"
                            @if (old('type3') == 'Operación') checked @endif value="Operación">
                        <label class="custom-control-label" for="type3">Operación</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Síntoma:</label>
                    <textarea name="description" id="description" type="text" rows="5"
                        placeholder="Descripción breve de sus síntomas..." required class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
            </form>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('/js/appointments/create.js') }}"></script>
    @endpush

@endsection
