<div class="btn-group" role="group" aria-label="Basic example">
    
    {{ $btnShow }}

    <a href="{{ $routeEdit }}" class="btn btn-primary btn-sm rounded" title="Editar"><i class="fas fa-edit"></i></a>

    <form id="formData" action="{{ $routeDestroy }}" method="post">
        @csrf
        @method('DELETE')
        {{ $funConfirm }}
        
    </form>
</div>
