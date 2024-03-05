const calificarPostulacionMessage = (response)=>{
    console.log(response)
    if (response) {
        const successMessage = Array.isArray(response.original.message) ? response.original.message.join('<br>') : response.original.message
        if (response.original.success) {
            Swal.fire('', successMessage, 'success').then((res) => {
                if (res) {
                    window.location.href = '/vacantes_mi_catedra'
                }
            })
        } else {
            Swal.fire('Error', successMessage, 'error')
        }
    };
}

const createPostulacionMessage = (response)=>{
    console.log(response)
    if (response) {
        const successMessage = Array.isArray(response.original.message) ? response.original.message.join('<br>') : response.original.message
        if (response.original.success) {
            Swal.fire('', successMessage, 'success').then((res) => {
                if (res) {
                    //console.log('a')
                    window.location.href = '/'
                }
            })
        } else {
            Swal.fire('Error', successMessage, 'error')
        }
    }
}