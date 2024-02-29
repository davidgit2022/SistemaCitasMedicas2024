{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
 --}}

<h6 class="heading-small text-muted mb-4">Información de perfil</h6>
<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>
<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')
    <div class="pl-lg-4">
        {{-- name and lastName --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="input-first-name">Nombre</label>
                    <input type="text" id="input-first-name" class="form-control form-control-alternative"
                        placeholder="Primer nombre" value="{{ old('name', $user->FormatName) }}"">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="input-last-name">Apellido</label>
                    <input type="text" id="input-last-name" class="form-control form-control-alternative"
                        placeholder="Apellido" value="{{ old('lastName', $user->FormatLastName) }}">
                </div>
            </div>
        </div>

        {{-- email and dni --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="email">Correo electrónico</label>
                    <input type="email" id="email" class="form-control form-control-alternative"
                        value="{{ old('email', $user->email) }}" placeholder="Correo electrónico" required
                        autocomplete="name">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="username">Cedula</label>
                    <input type="text" class="form-control 
                         id="dni" name="dni"
                        form-control-alternative" value="{{ old('dni', $user->dni) }}" required autofocus
                        autocomplete="dni">
                </div>
            </div>

        </div>

        {{-- address and mobile --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="email">Dirección</label>
                    <input type="address" id="address" class="form-control form-control-alternative"
                        value="{{ old('address', $user->address) }}" placeholder="Dirección" required
                        autocomplete="address">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="mobile">Celular</label>
                    <input type="text" class="form-control 
                         id="mobile" name="mobile"
                        form-control-alternative" value="{{ old('mobile', $user->mobile) }}" required autofocus
                        autocomplete="mobile">
                </div>
            </div>

        </div>

        {{-- Photo --}}
        <div class="row col-lg-12">
            <label for="mobile">Foto:</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFileLang" lang="en" name="photo">
                <label class="custom-file-label" for="customFileLang">Selecciona el archivo</label>
            </div>
        </div>
    </div>

</form>

<hr class="my-4" />
