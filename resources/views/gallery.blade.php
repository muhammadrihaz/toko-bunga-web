@extends('layouts.app')
@section('title', 'Gallery - Fania Flower Shop')

@section('content')
<!-- Page Header -->
<div class="bg-bg-soft-pink py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-serif text-brand-green mb-4">Galeri Kreatifitas</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Potret momen-momen indah dari karya dan dekorasi bunga yang kami kerjakan.</p>
    </div>
</div>

<section class="container mx-auto px-4 py-16">
    @if($galleries->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($galleries as $gallery)
        <div class="h-64 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] cursor-pointer group relative {{ $loop->iteration % 5 == 2 ? 'md:row-span-2 md:h-auto' : '' }}">
            <img src="{{ Storage::url($gallery->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $gallery->title ?? 'Gallery Image' }}" />
            @if($gallery->title)
            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-5 opacity-0 group-hover:opacity-100 transition duration-300">
                <p class="text-white font-medium text-sm translate-y-2 group-hover:translate-y-0 transition">{{ $gallery->title }}</p>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-20 bg-gray-50 rounded-2xl border border-gray-100">
        <i class="fa-solid fa-images text-4xl text-gray-300 mb-3"></i>
        <p class="text-gray-500 font-medium">Belum ada foto yang diunggah ke Galeri.</p>
    </div>
    @endif
</section>
@endsection
