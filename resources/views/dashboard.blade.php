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
        

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            @forelse($projects as $project)
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-bold text-lg mb-2">
                        {{ $project->name }}
                    </h3>

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
