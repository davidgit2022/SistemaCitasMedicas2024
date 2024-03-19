<script>
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: "CONFIRMAR",
            text: "¿Confirma que desea eliminar el registro?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5e72e4",
            cancelButtonColor: "#f5365c",
            confirmButtonText: "¡Sí, bórralo!",
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

