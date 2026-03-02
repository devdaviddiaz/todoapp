console.log('Edit Project JS cargado por Vite');

const form = document.querySelector('#projectForm');

const storeUrl = form.dataset.storeUrl;

form.addEventListener('submit', function(e) {
    e.preventDefault();

    // Limpiar errores anteriores
    document.getElementById('error-name').textContent = '';
    document.getElementById('error-description').textContent = '';

    let name = document.getElementById('name').value;
    let description = document.getElementById('description').value;

    let formData = new FormData();

    formData.append('_method', 'PUT');
    formData.append('name', name);
    formData.append('description', description);

    fetch(storeUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content'),
            'Accept': 'application/json',
        },
        body: formData,
    })
    .then(response => {
        if (response.status === 422) {
            return response.json().then(data => {
                let errors = data.errors;

                if (errors.name) {
                    document.getElementById('error-name').textContent = errors.name[0];
                }
                if (errors.description) {
                    document.getElementById('error-description').textContent = errors.description[0];
                }

                // Toast de error general
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Corrige los errores del formulario 💔',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'custom-toast'
                    }
                });
            });
        } 
        else if (response.ok) 
        {
            return response.json().then(data => {
                sessionStorage.setItem('success-toast', data.message);

                window.location.href = "/dashboard";
            });
        } else {
            throw new Error("Error del servidor");
        }
    })
})