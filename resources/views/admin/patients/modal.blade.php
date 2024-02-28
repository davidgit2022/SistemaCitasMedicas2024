@include('admin.doctors.include.header-modal-show')
@if ($patient->photo == null)
    <img src="{{ asset('img/perfil_default.png') }}" alt="not-available" class="img-fluid">
@else
    <img src="{{ asset($patient->photo) }}" alt="" class="img-fluid">
@endif
@include('admin.doctors.include.footer-modal-show')
