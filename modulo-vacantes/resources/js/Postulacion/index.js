
const calificarPostulacionMessage = (response) => {
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

const createPostulacionMessage = (response) => {
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

const emailHandler = () =>{
    const button_0 = document.getElementById('btn-open-modal-0');
    const button_1 = document.getElementById('btn-open-modal-1');
    
    button_0.addEventListener('click', function () {
        const email = this.dataset.email;
        const destino = this.dataset.dest;
        const llamado = this.dataset.llamado;
    
        document.getElementById('miModalLabel').textContent = 'Enviar mail a ' + email;
        document.querySelector('#miModal form').action = destino;
    });
    
    button_1.addEventListener('click', function () {
        const email = this.dataset.email;
        const destino = this.dataset.dest;
        const llamado = this.dataset.llamado;
    
        document.getElementById('miModalLabel').textContent = 'Enviar mail a ' + email;
        document.querySelector('#miModal form').action = destino;
    });
}

const popperHandler = ()=>{
    let popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    let popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
}