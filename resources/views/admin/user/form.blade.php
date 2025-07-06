<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ isset($user) ? 'Edit User' : 'Tambah User' }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                <div class="mt-2 relative">
                    <label>Password</label>
                    <input name="password" type="password" id="password" class="border rounded w-full pr-10" required>
                    <button type="button" onclick="togglePassword('password')"
                        class="absolute right-2 top-8 text-gray-600">
                        👁️
                    </button>
                </div>

                <div class="mt-2 relative">
                    <label>Konfirmasi Password</label>
                    <input name="password_confirmation" type="password" id="password_confirmation"
                        class="border rounded w-full pr-10" required>
                    <button type="button" onclick="togglePassword('password_confirmation')"
                        class="absolute right-2 top-8 text-gray-600">
                        👁️
                    </button>
                </div>

                <div class="mt-2">
                    <label>Departemen</label>
                    <select name="department_id" class="border rounded w-full">
                        <option value="">Pilih Departemen</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ isset($user) && $user->department_id == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

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
            @endif




            <div class="mt-4">
                <button class="bg-green-600 text-white px-4 py-2 rounded">
                    {{ isset($user) ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</x-app-layout>
