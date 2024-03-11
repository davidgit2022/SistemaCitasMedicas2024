<h6 class="heading-small text-muted mb-4">Información de perfil</h6>
<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="pl-lg-4">
        {{-- name and lastName --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="name">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control form-control-alternative"
                        placeholder="Primer nombre" value="{{ old('name', $user->FormatName) }}"">
                    @error('name')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="lastName">Apellido</label>
                    <input type="text" id="lastName" name="lastName" class="form-control form-control-alternative"
                        placeholder="Apellido" value="{{ old('lastName', $user->FormatLastName) }}">
                    @error('lastName')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        {{-- email and dni --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" class="form-control form-control-alternative"
                        value="{{ old('email', $user->email) }}" placeholder="Correo electrónico" required
                        autocomplete="name">
                    @error('email')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div class="container mt-2">
                            <p class="text-sm text-gray-800">
                                {{ __('Your email address is unverified.') }}
                                <button form="send-verification" class="btn btn-link btn-sm text-gray-600">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-success">
                                    {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                                </p>
                            @endif
                        </div>

                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="dni">Cedula</label>
                    <input type="text" class="form-control" id="dni" name="dni" form-control-alternative"
                        value="{{ old('dni', $user->dni) }}" required autofocus autocomplete="dni">
                    @error('dni')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
            </div>

        </div>

        {{-- address and mobile --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="address">Dirección</label>
                    <input type="address" id="address" name="address" class="form-control form-control-alternative"
                        value="{{ old('address', $user->address) }}" placeholder="Dirección" required
                        autocomplete="address">
                    @error('address')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="mobile">Celular</label>
                    <input type="text" class="form-control 
                         id="mobile" name="mobile"
                        form-control-alternative" value="{{ old('mobile', $user->mobile) }}" required autofocus
                        autocomplete="mobile">
                    @error('mobile')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
            </div>

        </div>

        {{-- Photo --}}
        <div class="row col-lg-12">
            <label for="photo" class="form-label">{{ __('Foto') }}</label>

            <input type="file" name="photo" id="photo" class="form-control-file" accept="image/*">

            @if ($user->photo)
                <div class="d-flex flex-column">
                    <label for="photo" class="form-label text-center">{{ __('Foto Actual') }}</label>
                    <div class="text-center">
                        @if ($user->photo != '')
                            <img src="{{ asset($user->photo) }}" class="img-fluid" alt="Foto Actual" width="300px"
                                height="60px">
                        @else
                            <img src="{{ asset('img/perfil_default.png') }}" class="img-fluid" alt="Foto Actual"
                                width="300px" height="60px">
                        @endif


                    </div>
                </div>
            @endif
            @error('photo')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
            @enderror
        </div>


        {{-- button save --}}
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="form-group">
                    <button class="btn btn-default">{{ __('Guardar') }}</button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                            class="text-sm text-success">{{ __('Datos Guardados.') }}</p>
                    @endif
                </div>
            </div>
        </div>

    </div>

</form>

<hr class="my-4" />
