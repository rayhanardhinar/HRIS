<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            {{ isset($department) ? 'Edit Department' : 'Tambah Department' }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white">
        <form method="POST"
            action="{{ isset($department) ? route('department.update', $department) : route('department.store') }}">
            @csrf
            @if (isset($department))
                @method('PUT')
            @endif

            <div>
                <label>Nama</label>
                <input name="name" value="{{ old('name', $department->name ?? '') }}" class="border rounded w-full"
                    required>
            </div>

            <div class="mt-4">
                <button class="bg-green-600 text-white px-4 py-2 rounded">
                    {{ isset($department) ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
