@extends('layouts.admin')
@section('title', 'Create Product')
@section('header_title', 'Add New Product')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-2xl">
    
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Product Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30" placeholder="e.g. Sweet Pink Bouquet">
            @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Product Image (Optional)</label>
            <input type="file" name="image" accept="image/*" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
            <p class="text-xs text-gray-500 mt-1">Leave empty to use a placeholder image.</p>
            @error('image')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Category <span class="text-red-500">*</span></label>
            <select name="category_id" required class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30">
                <option value="">Select a category...</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Jenis Bunga (Optional)</label>
            <select name="flower_type_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30">
                <option value="">Pilih Jenis Bunga...</option>
                @foreach($flowerTypes as $ft)
                    <option value="{{ $ft->id }}" {{ old('flower_type_id') == $ft->id ? 'selected' : '' }}>{{ $ft->name }}</option>
                @endforeach
            </select>
            @error('flower_type_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Price (Rp) <span class="text-red-500">*</span></label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">Rp</span>
                </div>
                <input type="number" name="price" value="{{ old('price') }}" required class="w-full pl-10 px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30" placeholder="250000">
            </div>
            @error('price')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Description (Optional)</label>
            <textarea name="description" rows="4" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30" placeholder="Tell the customer about this bouquet...">{{ old('description') }}</textarea>
            @error('description')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Instruksi Perawatan (Optional)</label>
            <textarea name="care_instructions" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30" placeholder="e.g. Ganti air setiap 2 hari...">{{ old('care_instructions') }}</textarea>
            @error('care_instructions')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Informasi Pengiriman (Optional)</label>
            <textarea name="delivery_info" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30" placeholder="e.g. Tersedia pengiriman Same Day...">{{ old('delivery_info') }}</textarea>
            @error('delivery_info')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Gallery Slider Images (Optional)</label>
            <input type="file" name="product_gallery[]" accept="image/*" multiple class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
            <p class="text-xs text-gray-500 mt-1">Select multiple images to create a gallery carousel. Primary image (cover) must be uploaded in the section above.</p>
        </div>
        
        <div class="flex items-center gap-3 bg-gray-50/50 p-4 rounded-lg border border-gray-100 mt-2">
            <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 text-brand-green bg-gray-100 border-gray-300 rounded focus:ring-brand-pink">
            <label for="is_active" class="text-sm font-medium cursor-pointer text-gray-700">Set as Active & Display in Catalogue</label>
        </div>

        <div class="flex items-center gap-3 mt-6 pt-6 border-t border-gray-100">
            <button type="submit" class="bg-brand-green text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-opacity-90 flex items-center gap-2">
                Save Product
            </button>
            <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium transition">
                Cancel
            </a>
        </div>
    </form>

</div>
@endsection
