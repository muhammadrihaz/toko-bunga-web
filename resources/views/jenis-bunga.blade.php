@extends('layouts.app')
@section('title', 'Jenis Bunga - Fania Flower Shop')

@section('content')
<!-- Page Header -->
<div class="bg-bg-soft-pink py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-serif text-brand-green mb-4">Jenis Bunga</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Kenali berbagai koleksi jenis bunga indah yang tersedia di toko kami.</p>
    </div>
</div>

<section class="container mx-auto px-4 py-16">
    @if($flowerTypes->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
        @foreach($flowerTypes as $type)
        <a href="{{ url('/catalogue?flower_type=' . $type->id) }}" class="block rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] cursor-pointer group relative bg-gray-100 aspect-square">
            <img src="{{ Storage::url($type->image_path) }}" class="w-full h-full object-cover block group-hover:scale-105 transition duration-500" alt="{{ $type->name ?? 'Jenis Bunga' }}" />
            
            @if($type->name)
            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 opacity-0 group-hover:opacity-100 transition duration-300">
                <p class="text-white font-medium text-xs md:text-sm translate-y-2 group-hover:translate-y-0 transition truncate">{{ $type->name }}</p>
            </div>
            @endif
        </a>
        @endforeach
    </div>
    @else
    <div class="text-center py-20 bg-gray-50 rounded-2xl border border-gray-100">
        <i class="fa-solid fa-seedling text-4xl text-gray-300 mb-3"></i>
        <p class="text-gray-500 font-medium">Belum ada jenis bunga yang tersedia saat ini.</p>
    </div>
    @endif
</section>

@endsection
