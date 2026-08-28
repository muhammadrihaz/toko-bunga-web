@extends('layouts.admin')
@section('title', 'Manage Jenis Bunga')
@section('header_title', 'Jenis Bunga')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Toolbar -->
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <h2 class="text-gray-800 font-medium">Semua Jenis Bunga</h2>
        <a href="{{ route('flower_types.create') }}" class="bg-brand-green text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-opacity-90 flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Tambah Jenis
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-gray-50/50 text-gray-700 uppercase font-medium">
                <tr>
                    <th scope="col" class="px-6 py-4">ID</th>
                    <th scope="col" class="px-6 py-4">Nama Jenis Bunga</th>
                    <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($flowerTypes as $type)
                <tr class="border-t border-gray-100 hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4 text-gray-500">
                        {{ $type->id }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $type->name }}
                    </td>
                    <td class="px-6 py-4 flex justify-end gap-2">
                        <a href="{{ route('flower_types.edit', $type->id) }}" class="p-2 text-brand-green hover:bg-brand-green/10 rounded transition">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('flower_types.destroy', $type->id) }}" method="POST" onsubmit="return confirm('Hapus jenis bunga ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded transition">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-gray-400">
                        Belum ada data Jenis Bunga.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
