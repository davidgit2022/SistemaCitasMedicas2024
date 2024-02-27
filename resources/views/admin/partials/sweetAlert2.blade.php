<script>
    $('#formData').on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: "CONFIRMAR",
            text: "CONFIRMAS ELIMINAR EL REGISTRO",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5e72e4",
            cancelButtonColor: "#f5365c",
            confirmButtonText: "¡Sí, bórralo!",
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit()
            }
        });
    })
</script>