<div class="btn-group" role="group" aria-label="Basic example">
    <a href="{{ $routeEdit }}" class="btn btn-primary btn-sm" title="Editar"><i
            class="fas fa-edit"></i></a>
    <form action="{{ $routeDestroy }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i
                class="fas fa-trash"></i></button>
    </form>
</div>