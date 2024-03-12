const handleMessage = (response)=>{
    console.log(response)
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


const handleTooltip= ()=>{
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
}