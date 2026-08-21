@extends('layouts.admin')
@section('title', 'Manage Categories')
@section('header_title', 'Categories')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Toolbar -->
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <h2 class="text-gray-800 font-medium">All Categories</h2>
        <a href="{{ route('categories.create') }}" class="bg-brand-green text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-opacity-90 flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Add Category
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-gray-50/50 text-gray-700 uppercase font-medium">
                <tr>
                    <th scope="col" class="px-6 py-4">Name</th>
                    <th scope="col" class="px-6 py-4">Slug</th>
                    <th scope="col" class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr class="border-t border-gray-100 hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4 flex items-center gap-3">
                        @if($category->image_path)
                            <div class="w-12 h-12 rounded-lg overflow-hidden shrink-0 border border-gray-200">
                                <img src="{{ Storage::url($category->image_path) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-12 h-12 rounded-lg bg-gray-100 text-gray-400 flex items-center justify-center shrink-0 border border-gray-200">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                        @endif
                        <span class="font-medium text-gray-900">{{ $category->name }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">
                        {{ $category->slug }}
                    </td>
                    <td class="px-6 py-4 flex justify-end gap-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="p-2 text-brand-green hover:bg-brand-green/10 rounded transition">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?');">
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
                        No categories found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
