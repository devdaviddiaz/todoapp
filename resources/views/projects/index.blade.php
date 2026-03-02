<x-layouts.app :title="'My Projects'">
    <div class="space-y-6">

        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold">My projects</h1>

            <a
                href="{{ route('projects.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-semibold"
            >
                + New project
            </a>
        </div>

        <x-projects.grid-card-project :projects="$projects" ></x-projects.grid-card-project>

    </div>
</x-layouts.app>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mostrar toast si hay mensaje
        let successMessage = sessionStorage.getItem('success-toast');
        if (successMessage) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: successMessage,
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                customClass: {
                    popup: 'custom-toast'
                }
            });
            sessionStorage.removeItem('success-toast');
        }
    });
    
    // Manejar múltiples formularios de eliminación
    let deleteForms = document.querySelectorAll('.form-delete');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "This action will delete the post. 💔",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(form.action, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json",
                            "Accept": "application/json"
                        },
                        body: JSON.stringify({
                            _method: 'DELETE'
                        })
                    })
                    .then(response => {
                        if (response.status === 422) {
                            return response.json().then(data => {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Something went wrong 💔',
                                    showConfirmButton: false,
                                    timer: 4000,
                                    timerProgressBar: true,
                                    customClass: {
                                        popup: 'custom-toast'
                                    }
                                });
                            });
                        } else if (response.ok) {
                            return response.json().then(data => {
                                sessionStorage.setItem('success-toast', data.message);
                                window.location.href = "/projects";
                            });
                        } else {
                            throw new Error("Error del servidor");
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong 😢',
                            footer: '<a href="#">¿Necesitas ayuda?</a>'
                        });
                    });
                }
            });
        });
    });
</script>