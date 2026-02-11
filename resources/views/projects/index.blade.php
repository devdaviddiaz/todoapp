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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($projects as $project)
                <a
                    href="{{ route('projects.show', $project) }}"
                    class="block bg-white rounded-xl shadow p-6 hover:shadow-lg transition"
                >
                    <h3 class="font-bold text-lg mb-2">
                        {{ $project->name }}
                    </h3>

                    <p class="text-gray-600 text-sm">
                        {{ $project->description ?? 'Sin descripción' }}
                    </p>
                </a>
            @empty
                <p>No tienes proyectos todavía 🥺</p>
            @endforelse
        </div>

    </div>
</x-layouts.app>
