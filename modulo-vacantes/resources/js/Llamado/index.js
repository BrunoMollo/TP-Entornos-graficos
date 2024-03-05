const createLlamadoMessage = (response)=>{
    console.log(response)
    if (response) {
        const successMessage = Array.isArray(response.original.message) ? response.original.message.join('<br>') : response.original.message
        if (response.original.success) {
            Swal.fire('', successMessage, 'success').then((res) => {
                if (res) {
                    window.location.href = 'administrar_llamados'
                }
            })
        } else {
            Swal.fire('Error', successMessage, 'error')
        }
    };
}

const editLlamadoMessage = (response)=>{
    console.log(response)
    if (response) {
        const successMessage = Array.isArray(response.original.message) ? response.original.message.join('<br>') : response.original.message
        if (response.original.success) {
            Swal.fire('', successMessage, 'success').then((res) => {
                if (res) {
                    window.location.href = '/admin/administrar_llamados'
                }
            })
        } else {
            Swal.fire('Error', successMessage, 'error')
        }
    };
}

const indexLlamadoMessage = (response)=>{
    console.log(response)
    if (response) {
        const successMessage = Array.isArray(response.original.message) ? response.original.message.join('<br>') : response.original.message
        if (response.original.success) {
            Swal.fire('', successMessage, 'success')
        } else {
            Swal.fire('Error', successMessage, 'error').then((res) => {
                if (res && response.original.id) {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Se eliminarán todas las postulaciones asociadas a este llamado.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar',
                        cancelButtonColor: '#6c757d',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log(response.original.id)
                            document.getElementById(`form-eliminar-postulaciones-${response.original.id}`).submit();
                        }
                    });
                }
            })
        }
    };

}

const aceptar = (id) => {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
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
            document.getElementById(`form-eliminar-${id}`).submit();
        }
    })
}


