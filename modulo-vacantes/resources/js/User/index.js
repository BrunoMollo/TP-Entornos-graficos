const cargarDatatable = () =>{
    $(document).ready(function () {
        $('#usersTable').DataTable({
            pagingType: 'full_numbers',
            lengthMenu: [10, 25, 50],
            searching: true,
            "language": {
                "search": "Buscar:",
                "lengthMenu": "Mostrar _MENU_ usuarios por página",
                "zeroRecords": "No se encontraron usuarios",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 usuarios",
                "infoFiltered": "(filtrado de _MAX_ usuarios totales)",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    }); 
}

const aceptar = (id) => {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Si este usuario tiene postulaciones, estas se eliminarán ¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    }).then((res) => {
        if (res.isConfirmed) {
            document.getElementById(`eliminar-user-${id}`).submit();
        }
    })
}

