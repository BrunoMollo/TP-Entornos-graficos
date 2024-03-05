const handleMessage = (response)=>{
    if (response) {
        const successMessage = response.original.message.join('<br>')
        if (response.original.success) {
            Swal.fire('', successMessage, 'success')
        } else {
            Swal.fire('Error', successMessage, 'error')
        }
    };
}

const test = (response)=>{
    console.log(response)
}

