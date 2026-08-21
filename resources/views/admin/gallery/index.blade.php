@extends('layouts.admin')
@section('title', 'Manage Gallery')
@section('header_title', 'Gallery Portfolio')

@section('content')
<div class="mb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 max-w-2xl">
        <h3 class="text-lg font-medium text-gray-800 mb-4">Upload New Image</h3>
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">File Upload <span class="text-red-500">*</span></label>
                <input type="file" name="image" required accept="image/*" class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Caption / Title</label>
                <input type="text" name="title" placeholder="Optional caption" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/30">
            </div>
            <button type="submit" class="bg-brand-green text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-opacity-90 self-start">
                <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Upload Image
            </button>
        </form>
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
    @forelse($galleries as $image)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group">
            <div class="aspect-square relative overflow-hidden bg-gray-100">
                <img src="{{ Storage::url($image->image_path) }}" alt="{{ $image->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform">
                    <p class="text-white text-sm font-medium">{{ $image->title }}</p>
                </div>
            </div>
            <div class="p-3 bg-gray-50/50 flex justify-end">
                <form action="{{ route('gallery.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Delete this image?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-600 text-sm font-medium flex items-center justify-center p-2 bg-white rounded-lg border border-gray-200 hover:border-red-500 transition">
                        <i class="fa-solid fa-trash-can mr-1.5"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full py-12 text-center text-gray-500 bg-white rounded-2xl shadow-sm border border-gray-100">
            <i class="fa-regular fa-images text-4xl mb-4 text-gray-300"></i>
            <p>No images in your gallery yet.</p>
        </div>
    @endforelse
</div>
<div class="mt-6">
    {{ $galleries->links() }}
</div>
@endsection
