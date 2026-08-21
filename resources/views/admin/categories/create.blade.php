@extends('layouts.admin')
@section('title', 'Create Category')
@section('header_title', 'Add New Category')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 max-w-xl">
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Category Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30" placeholder="e.g. Wedding Bouquets">
            @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Category Image (Optional)</label>
            <input type="file" name="image" accept="image/*" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
            @error('image')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center gap-3 mt-4">
            <button type="submit" class="bg-brand-green text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-opacity-90 flex items-center gap-2">
                Save Category
            </button>
            <a href="{{ route('categories.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
