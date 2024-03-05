const aceptar = (postId) => {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Se cancelará tu postulación!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    }).then((res) => {
        console.log('epa')
        if (res.isConfirmed) {
            document.getElementById(`cancelar-postulacion-${postId}`).submit()
        }
    })
}