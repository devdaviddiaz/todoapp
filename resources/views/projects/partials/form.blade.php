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
        value="{{ old('name', $project->name ?? '') }}"
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
    >{{ old('description', $project->description ?? '') }}</textarea>
    <div class="text-danger form-text" id="error-description"></div>
</div>