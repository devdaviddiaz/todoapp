<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h2 class="text-3xl font-bold mb-8">Hola, {{ auth()->user()->name }} 👋</h2>
        
        {{-- PROYECTOS --}}
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">Tus proyectos</h2>

            <a
                href="{{ route('projects.index') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-semibold"
            >
                Projects
            </a>
        </div>
        
        <x-projects.grid-card-project :projects="$projects" ></x-projects.grid-card-project>
        

        {{-- TAREAS POR ESTADO --}}
        <h2 class="text-xl font-semibold mb-4">Tus tareas</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($tasksByStatus as $status => $tasks)
                <div class="bg-gray-50 rounded-xl p-4">
                    <h3 class="font-semibold mb-3">{{ $status }}</h3>

                    <ul class="space-y-2">
                        @foreach($tasks as $task)
                            <li class="bg-white p-3 rounded shadow-sm text-sm">
                                {{ $task->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @empty
                <p>No tienes tareas todavía 🥺</p>
            @endforelse
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
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
                                window.location.href = "/dashboard";
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