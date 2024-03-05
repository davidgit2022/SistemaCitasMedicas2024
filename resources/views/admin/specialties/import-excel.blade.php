@extends('layouts.theme.app')

@section('title', 'Importar especialidades')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0 text-center">Cargar especialidades</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.specialties.include.error-validation-import')
                </div>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <form action="{{ route('specialties.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="documento">Cargar el documento:</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="excel_file"class="custom-file-input"
                                                    id="documento" accept=".xlsx,.xls">

                                                <label class="custom-file-label" for="excel_file">Elegir archivo</label>

                                            </div>

                                        </div>
                                        <div class="mt-2">
                                            @error('excel_file')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Importar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
