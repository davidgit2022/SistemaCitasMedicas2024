@if (session('notification'))
    <div class="alert alert-success" role="alert">
        {{ session('notification') }}
    </div>
@elseif (session('error'))  
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif



