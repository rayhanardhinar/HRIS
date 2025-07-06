<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ isset($user) ? 'Edit User' : 'Tambah User' }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white">
        <form method="POST" action="{{ isset($user) ? route('user.update', $user) : route('user.store') }}">
            @csrf
            @if (isset($user))
                @method('PUT')
            @endif

            <div>
                <label>Nama</label>
                <input name="name" value="{{ old('name', $user->name ?? '') }}" class="border rounded w-full" required>
            </div>

            <div class="mt-2">
                <label>Email</label>
                <input name="email" type="email" value="{{ old('email', $user->email ?? '') }}"
                    class="border rounded w-full" required>
            </div>

            @if (!isset($user))
                <div class="mt-2">
                    <label>Password</label>
                    <input name="password" type="password" class="border rounded w-full" required>
                </div>
                <div class="mt-2">
                    <label>Konfirmasi Password</label>
                    <input name="password_confirmation" type="password" class="border rounded w-full" required>
                </div>
            @endif

            <div class="mt-2">
                <label>Role</label>
                <select name="role" class="border rounded w-full">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}"
                            {{ isset($user) && $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <button class="bg-green-600 text-white px-4 py-2 rounded">
                    {{ isset($user) ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
