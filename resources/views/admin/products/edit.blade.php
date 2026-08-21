@extends('layouts.admin')
@section('title', 'Edit Product')
@section('header_title', 'Edit Product')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-2xl">
    
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Product Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30">
            @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Product Image</label>
            @if($product->image_path)
                <div class="mb-3 w-32 h-32 rounded-xl overflow-hidden border border-gray-200">
                    <img src="{{ Storage::url($product->image_path) }}" class="w-full h-full object-cover">
                </div>
            @endif
            <input type="file" name="image" accept="image/*" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
            <p class="text-xs text-gray-500 mt-1">Upload a new image to replace the current one.</p>
            @error('image')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Category <span class="text-red-500">*</span></label>
            <select name="category_id" required class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30">
                <option value="">Select a category...</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Price (Rp) <span class="text-red-500">*</span></label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">Rp</span>
                </div>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" required class="w-full pl-10 px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30">
            </div>
            @error('price')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Description (Optional)</label>
            <textarea name="description" rows="4" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30">{{ old('description', $product->description) }}</textarea>
            @error('description')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Instruksi Perawatan (Optional)</label>
            <textarea name="care_instructions" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30">{{ old('care_instructions', $product->care_instructions) }}</textarea>
            @error('care_instructions')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Informasi Pengiriman (Optional)</label>
            <textarea name="delivery_info" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30">{{ old('delivery_info', $product->delivery_info) }}</textarea>
            @error('delivery_info')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>
        
        <div class="border-t border-gray-100 pt-5 mt-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Gallery Slider Images</label>
            
            @if($product->images && $product->images->count() > 0)
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3 mb-4">
                    @foreach($product->images as $img)
                        <div class="relative w-full aspect-square rounded-lg border border-gray-200 overflow-hidden group">
                            <img src="{{ Storage::url($img->image_path) }}" class="w-full h-full object-cover">
                            <button type="button" onclick="confirmGalleryDelete('{{ route('products.destroyImage', $img->id) }}')" class="absolute inset-0 bg-black/60 text-white flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <i class="fa-solid fa-trash mb-1"></i>
                                <span class="text-[10px]">Delete</span>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
            
            <input type="file" name="product_gallery[]" accept="image/*" multiple class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
            <p class="text-xs text-gray-500 mt-1">Select multiple images to append to the gallery carousel.</p>
        </div>
        
        <div class="flex items-center gap-3 bg-gray-50/50 p-4 rounded-lg border border-gray-100 mt-2">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} class="w-4 h-4 text-brand-green bg-gray-100 border-gray-300 rounded focus:ring-brand-pink">
            <label for="is_active" class="text-sm font-medium cursor-pointer text-gray-700">Set as Active & Display in Catalogue</label>
        </div>

        <div class="flex items-center gap-3 mt-6 pt-6 border-t border-gray-100">
            <button type="submit" class="bg-brand-green text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-opacity-90 flex items-center gap-2">
                Update Product
            </button>
            <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium transition">
                Cancel
            </a>
        </div>
    </form>

</div>

<!-- Hidden Delete Form for Gallery Images -->
<form id="deleteImageForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
<script>
    function confirmGalleryDelete(url) {
        if (confirm('Are you sure you want to delete this gallery image? This action cannot be undone.')) {
            let form = document.getElementById('deleteImageForm');
            form.action = url;
            form.submit();
        }
    }
</script>
@endsection
