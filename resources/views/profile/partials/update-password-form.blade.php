<h6 class="heading-small text-muted mb-4">Actualizar contraseña</h6>

<div class="pl-lg-4">
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-md-12">
                <p class="mt-1 text-sm text-muted">
                    {{ __('Asegúrate de que tu cuenta utiliza una contraseña larga y aleatoria para mantener la seguridad.') }}
                </p>
                {{-- Password --}}
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input id="update_password_current_password" name="current_password" type="password"
                        class="form-control" autocomplete="current-password">

                    @error('updatePassword.password')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{-- Confirmation Password --}}
                <div class="form-group">
                    <label for="password_confirmation">Nueva Contraseña:</label>
                    <input id="update_password_password" name="password" type="password" class="form-control"
                        autocomplete="new-password">
                    @error('password')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{-- Confirmation Password --}}
                <div class="form-group">
                    <label for="password_confirmation">Confirmar contraseña:</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                        class="form-control" autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="text-danger">
                            <span>*{{ $message }}</span>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-default">{{ __('Guardar') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 5000)"
                    class="text-sm text-muted"
                >{{ __('Contraseña actualizada.') }}</p>
            @endif
        </div>
    </form>

</div>



<hr class="my-4" />
