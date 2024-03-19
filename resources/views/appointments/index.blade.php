@extends('layouts.theme.app')

@section('title', 'Mis citas')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Mis citas</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif
            
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" data-link="confirmed_appointments" data-toggle="tab" href="#mis-citas" role="tab"
                            aria-selected="true"><i class="ni ni-calendar-grid-58 mr-2"></i>Mis citas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" data-link="pending_appointments" data-toggle="tab" href="#citas-pendientes" role="tab"
                            aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Citas pendientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" data-link="old_appointments" data-toggle="tab" href="#historial" role="tab"
                            aria-selected="false"><i class="ni ni-folder-17 mr-2"></i>Historial</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card shadow">
            <div class="card">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="mis-citas" role="tabpanel">
                        @include('appointments.tables.confirmed_appointments')
                    </div>
                    <div class="tab-pane fade" id="citas-pendientes" role="tabpanel">
                        @include('appointments.tables.pending_appointments')
                    </div>
                    <div class="tab-pane fade" id="historial" role="tabpanel">
                        @include('appointments.tables.old_appointments')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let tab;
            let mS = window.localStorage
            mS.setItem('tabActive', ' ')
            
            let elements = document.querySelectorAll(".nav-link");
            elements.forEach(element => {

                element.addEventListener('click', () => {
                    tab = element.getAttribute("data-link");
                    mS.setItem('tabActive', tab)

                    console.log(mS.tabActive);
                    
                });

                if (mS.tabActive === tab) {
                    element.classList.add('active')
                }else {
                    element.classList.remove('active')
                }
            });

        </script>
    @endpush
@endsection
