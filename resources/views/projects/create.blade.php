<x-layouts.app :title="__('Create project')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="text-3xl font-bold mb-6">Create new project</h1>

        <form
            id="projectForm"
            data-store-url="{{ route('projects.store') }}"
            action="{{ route('projects.store') }}"
            method="POST"
            class="dark py-6 rounded-xl shadow space-y-4"
        >
            @csrf

            {{-- Nombre --}}
            <div>
                <label class="block font-medium mb-1">
                    Project name
                </label>
                <input
                    autocomplete="off"
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full rounded-md border-1 border-gray-300 focus:ring-indigo-500 px-3 py-2.5"
                    required
                >
                <div class="text-danger form-text" id="error-name"></div>
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block font-medium mb-1">
                    Description
                </label>
                <textarea
                    autocomplete="off"
                    id="description"
                    name="description"
                    rows="3"
                    class="w-full rounded-md border-1 border-gray-300 focus:ring-indigo-500 px-3 py-2.5"
                >{{ old('description') }}</textarea>
                <div class="text-danger form-text" id="error-description"></div>
            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-2">
                <a
                    href="{{ route('projects.index') }}"
                    class="px-4 py-2 rounded-lg border"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700"
                >
                    Create project
                </button>
            </div>

        </form>
    </div>
</x-layouts.app>