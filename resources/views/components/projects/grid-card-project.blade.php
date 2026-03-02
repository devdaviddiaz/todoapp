<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    @forelse($projects as $project)
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between">
                <!-- Title card -->
                <h3 class="font-bold text-lg text-indigo-600">
                    {{ $project->name }}
                </h3>

                <!-- Dropdown Button -->
                <div class="relative inline-block text-left">
                    <button 
                        class="dropdownBtn bg-indigo-600 text-white px-0.5 py-0.5 rounded-full hover:bg-indigo-700 transition text-sm font-semibold flex items-center gap-2 cursor-pointer"
                        type="button"
                    >
                        <svg  xmlns="http://www.w3.org/2000/svg" width="22" height="22"  
                            fill="currentColor" viewBox="0 0 24 24" >
                            <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                            <path d="M12 10a2 2 0 1 0 0 4 2 2 0 1 0 0-4m0 6a2 2 0 1 0 0 4 2 2 0 1 0 0-4m0-12a2 2 0 1 0 0 4 2 2 0 1 0 0-4"></path>
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="dropdownMenu hidden absolute right-0 mt-2 w-34 origin-top-right bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <ul class="p-1 text-neutral-600">
                            <li>
                                <a class="flex items-center gap-2 px-2 py-1.5 hover:bg-gray-100 font-medium rounded-sm transition-all duration-500"
                                    href="{{ route('projects.edit', $project->id) }}">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.6711 4.48785L11.4428 9.78833C11.2429 9.99099 11.143 10.0923 11.0761 10.2152L11.0727 10.2215C11.0067 10.3448 10.9772 10.4832 10.9184 10.7599C10.6297 12.1177 10.4853 12.7966 10.8705 13.1765C10.8766 13.1825 10.8827 13.1885 10.889 13.1943C11.2839 13.5644 11.9721 13.4037 13.3486 13.0822C13.6235 13.0181 13.7609 12.986 13.8822 12.9197L13.8839 12.9187C14.0051 12.8521 14.1048 12.7545 14.3042 12.5592L19.6099 7.36337C20.2676 6.71937 20.5964 6.39736 20.6034 5.99372C20.6103 5.59008 20.2928 5.25743 19.6579 4.59212L19.5804 4.51093C18.9033 3.80151 18.5647 3.4468 18.1347 3.44338C17.7047 3.43997 17.3602 3.78926 16.6711 4.48785Z"
                                            stroke="#737373" stroke-width="2" class="my-path"></path>
                                        <path d="M19.0007 8.00004L16 5" stroke="#737373" stroke-width="2" class="my-path">
                                        </path>
                                        <path
                                            d="M13.5882 3H11C7.22876 3 5.34315 3 4.17157 4.17157C3 5.34315 3 7.22876 3 11V13C3 16.7712 3 18.6569 4.17157 19.8284C5.34315 21 7.22876 21 11 21H13C16.7712 21 18.6569 21 19.8284 19.8284C21 18.6569 21 16.7712 21 13V11.4706"
                                            stroke="#737373" stroke-width="2" stroke-linecap="round" class="my-path"></path>
                                    </svg>Edit </a>
                            </li>
                            <!--<div class="bg-gray-200 -mx-1 my-1 h-px"></div>-->
                            <li>
                                <form class="form-delete" action="{{ route('projects.destroy', $project) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="block px-2 py-1 hover:bg-gray-100 flex items-center gap-2 text-red-500 font-medium rounded-sm transition-all duration-500 w-full cursor-pointer"
                                        href="javascript:;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M3 6.60001H21M4.8 6.60001H19.2V15C19.2 17.8284 19.2 19.2426 18.3213 20.1213C17.4426 21 16.0284 21 13.2 21H10.8C7.97157 21 6.55736 21 5.67868 20.1213C4.8 19.2426 4.8 17.8284 4.8 15V6.60001Z"
                                                stroke="#f44336" stroke-width="2" stroke-linecap="round" class="my-path"></path>
                                            <path
                                                d="M7.49994 6.59994V4.99994C7.49994 3.89537 8.39537 2.99994 9.49994 2.99994H14.4999C15.6045 2.99994 16.4999 3.89537 16.4999 4.99994V6.59994M16.4999 6.59994H2.99994M16.4999 6.59994H21"
                                                stroke="#f44336" stroke-width="2" stroke-linecap="round" class="my-path"></path>
                                            <path d="M10.2 11.1L10.2 16.5" stroke="#f44336" stroke-width="2" stroke-linecap="round"
                                                class="my-path"></path>
                                            <path d="M13.8 11.1L13.8 16.5" stroke="#f44336" stroke-width="2" stroke-linecap="round"
                                                class="my-path"></path>
                                        </svg> Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <p class="text-gray-600 text-sm mb-4">
                {{ $project->description ?? 'Sin descripción' }}
            </p>

            <span class="text-sm font-medium text-indigo-600">
                {{ $project->tasks_count }} tareas
            </span>
        </div>
    @empty
        <p>No tienes proyectos todavía 🥺</p>
    @endforelse
</div>

<script>
    const buttons = document.querySelectorAll('.dropdownBtn');

    buttons.forEach(button => {

        const container = button.closest('.relative');
        const menu = container.querySelector('.dropdownMenu');

        button.addEventListener('click', (e) => {
            e.stopPropagation();

            // Cerrar todos los demás
            document.querySelectorAll('.dropdownMenu').forEach(m => {
                if (m !== menu) m.classList.add('hidden');
            });

            // Toggle del actual
            menu.classList.toggle('hidden');
        });
    });

    // Cerrar al hacer click fuera
    document.addEventListener('click', () => {
        document.querySelectorAll('.dropdownMenu').forEach(menu => {
            menu.classList.add('hidden');
        });
    });
</script>