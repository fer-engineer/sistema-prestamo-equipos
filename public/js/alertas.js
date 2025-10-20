document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-eliminar');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const form = this.closest('form');
            const row = this.closest('tr');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        body: new URLSearchParams({
                            '_method': 'DELETE'
                        })
                    })
                    .then(response => response.json()) // Siempre parsea la respuesta como JSON
                    .then(data => {
                        if (data.success) {
                            // Si la operación fue exitosa
                            row.remove();
                            Swal.fire(
                                '¡Eliminado!',
                                data.message || 'El registro ha sido eliminado.',
                                'success'
                            );
                        } else {
                            // Si la operación falló (controlado por el backend)
                            Swal.fire(
                                'Acción no permitida',
                                data.message || 'No se pudo eliminar el registro.',
                                'warning'
                            );
                        }
                    })
                    .catch(error => {
                        // Para errores de red o si response.json() falla
                        console.error('Error en fetch:', error);
                        Swal.fire(
                            'Error',
                            'Ocurrió un problema de conexión o un error inesperado en el servidor.',
                            'error'
                        );
                    });
                }
            });
        });
    });
});