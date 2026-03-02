<x-layouts.app :title="__('Edit project')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="text-3xl font-bold mb-6">Edit project</h1>

        <form
            id="projectForm"
            data-store-url="{{ route('projects.update', $project) }}"
            action="{{ route('projects.update', $project) }}"
            method="POST"
            class="dark py-6 rounded-xl shadow space-y-4"
        >
            @csrf
            @method('PUT')

            @include('projects.partials.form')

            {{-- Botones --}}
            <div class="flex justify-end gap-2">
                <a
                    href="{{ route('projects.index') }}"
                    class="px-4 py-2 rounded-lg border hover:bg-neutral-700"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 cursor-pointer"
                >
                    Edit project
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
@vite([
    'resources/js/projects/editProject.js'
])
