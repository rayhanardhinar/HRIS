<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">Manajemen Department</h2>
    </x-slot>

    <div class="p-6 bg-white">
        <a href="{{ route('department.create') }}" class="bg-blue-500 px-4 py-2 text-white rounded">Tambah Department</a>
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr>
                        <td>{{ $department->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('department.edit', $department->id) }}" class="text-blue-600">Edit</a> |
                            <form method="POST" action="{{ route('department.destroy', $department) }}" class="inline">
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
