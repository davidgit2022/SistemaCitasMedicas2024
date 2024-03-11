@extends('layouts.theme.app')
@section('title', 'Perfil')
@section('content')

    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
        style="min-height: 600px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Hola {{ $user->FormatName }} </h1>
                    <p class="text-white mt-0 mb-5">Esta es tu página de perfil. Puedes realizar los ajustes, que creas
                        convenientes.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    @if ($user->photo != '')
                                        <img src=" {{ asset($user->photo) }}" class="rounded-circle">
                                    @else
                                        <img src="{{ asset('img/perfil_default.png') }}" alt="not-available"
                                            class="img-fluid">
                                    @endif

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">

                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>{{ $user->FormatName }}<span class="font-weight-light">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Mi cuenta</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>

                            <!-- INFORMACIÓN DE PERFIL -->
                            @include('profile.partials.update-profile-information-form')


                            <!-- ACTUALIZAR CONTRASEÑA -->
                            @include('profile.partials.update-password-form')


                            <!-- ELIMINAR CUENTA -->
                            @include('profile.partials.delete-user-form')

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
