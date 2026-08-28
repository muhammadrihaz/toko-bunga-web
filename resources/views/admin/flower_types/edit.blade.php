@extends('layouts.admin')
@section('title', 'Edit Jenis Bunga')
@section('header_title', 'Edit Jenis Bunga')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-2xl">
    
    <form action="{{ route('flower_types.update', $flowerType->id) }}" method="POST" class="flex flex-col gap-5">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Jenis Bunga <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $flowerType->name) }}" required class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30">
            @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center gap-3 mt-4 pt-4 border-t border-gray-100">
            <button type="submit" class="bg-brand-green text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-opacity-90 flex items-center gap-2">
                Simpan Perubahan
            </button>
            <a href="{{ route('flower_types.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium transition">
                Batal
            </a>
        </div>
    </form>

</div>
@endsection
