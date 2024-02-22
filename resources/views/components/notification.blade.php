@if (session('notification'))
    <div class="alert alert-success" role="alert">
        {{ session('notification') }}
    </div>
@endif
