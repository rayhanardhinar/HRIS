<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Manajemen User</h2>
    </x-slot>

    <div class="p-6 bg-white">
        <a href="{{ route('user.create') }}" class="bg-blue-500 px-4 py-2 text-white rounded">Tambah User</a>
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoleNames()->join(', ') }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user) }}" class="text-blue-600">Edit</a> |
                            <form method="POST" action="{{ route('user.destroy', $user) }}" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin?')" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
