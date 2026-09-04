@extends('layouts.app')
@section('title', $product->name . ' - Fania Flower Shop')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-50 border-b border-gray-100">
    <div class="container mx-auto px-4 py-3 text-xs text-gray-500">
    <a href="{{ url('/') }}" class="hover:text-brand-pink transition">Beranda</a>
    <span class="mx-2">/</span>
    <a href="{{ url('/catalogue') }}" class="hover:text-brand-pink transition">Catalogue</a>
    <span class="mx-2">/</span>
    <span class="text-gray-800 font-medium">{{ $product->name }}</span>
    </div>
</div>

<!-- Product Detail Section -->
<section class="container mx-auto px-4 py-12 md:py-16">
    <div class="flex flex-col md:flex-row gap-10">
    <!-- Left: Image Gallery -->
    <div class="w-full md:w-1/2 flex flex-col gap-4">
        <div class="w-full h-80 md:h-[500px] overflow-hidden rounded-2xl shadow-soft border border-gray-100">
            @php $mainImagePath = $product->image_path ? Storage::url($product->image_path) : ($product->images->first() ? Storage::url($product->images->first()->image_path) : 'https://placehold.co/800x800'); @endphp
            <img id="main-product-img" src="{{ $mainImagePath }}" alt="{{ $product->name }}" class="w-full h-full object-contain bg-gray-50/50" />
        </div>
        
        <div class="flex gap-4 overflow-x-auto no-scrollbar py-2">
            @if($product->image_path)
                <img src="{{ Storage::url($product->image_path) }}" class="thumbnail active ring-2 ring-brand-pink w-20 h-20 md:w-24 md:h-24 rounded-lg object-cover cursor-pointer" />
            @endif
            @foreach($product->images as $img)
                <img src="{{ Storage::url($img->image_path) }}" class="thumbnail w-20 h-20 md:w-24 md:h-24 rounded-lg object-cover cursor-pointer {{ (!$product->image_path && $loop->first) ? 'active ring-2 ring-brand-pink' : 'border border-gray-100' }}" />
            @endforeach
        </div>
    </div>

    <!-- Right: Product Info -->
    <div class="w-full md:w-1/2">
        <div class="mb-6 border-b border-gray-100 pb-6">
        <h1 class="text-3xl md:text-4xl font-serif text-brand-green mb-2">{{ $product->name }}</h1>
        <div class="flex items-center gap-4 mb-4">
            <span class="text-2xl md:text-3xl font-semibold text-brand-pink">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
            <span class="bg-bg-soft-green text-brand-green px-3 py-1 rounded-full text-xs font-medium">Tersedia</span>
        </div>
        </div>

        <div class="mb-8">
        <h4 class="font-medium text-gray-800 mb-2">Deskripsi Produk</h4>
        <div class="text-gray-600 text-sm leading-relaxed">
            {!! nl2br(e($product->description ?? 'Belum ada deskripsi.')) !!}
        </div>
        </div>

        <!-- Whatsapp action -->
        @php
            $productUrl = url('/product-detail?id=' . $product->id);
            $imagePath = $product->image_path ?: ($product->images->first() ? $product->images->first()->image_path : null);
            $imageUrl = $imagePath ? asset(Storage::url($imagePath)) : null;
        @endphp
        <a href="{{ \App\Models\Setting::getWhatsAppUrl($product->name, $product->price, $productUrl, $imageUrl) }}" target="_blank" rel="noopener noreferrer" class="w-full bg-brand-green text-white py-3.5 rounded-full text-sm font-medium hover:bg-opacity-90 hover:shadow-glow-green transition shadow-md flex items-center justify-center gap-2 mb-8 mt-2">
        <i class="fa-brands fa-whatsapp text-lg"></i> Pesan Langsung via WhatsApp
        </a>

        <!-- Care & Delivery accordions -->
        <div class="border border-gray-100 rounded-lg overflow-hidden bg-white mb-8">
            <details class="group border-b border-gray-100">
                <summary class="p-4 bg-gray-50/50 hover:bg-gray-50 flex justify-between items-center cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                    <span class="font-medium text-sm text-gray-800">Instruksi Perawatan</span>
                    <i class="fa-solid fa-chevron-down text-gray-400 text-xs transition group-open:rotate-180"></i>
                </summary>
                <div class="p-4 text-sm text-gray-600 leading-relaxed bg-white">
                    {!! nl2br(e($product->care_instructions ?? 'Tidak ada instruksi khusus untuk produk ini.')) !!}
                </div>
            </details>
            <details class="group">
                <summary class="p-4 bg-gray-50/50 hover:bg-gray-50 flex justify-between items-center cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                    <span class="font-medium text-sm text-gray-800">Informasi Pengiriman</span>
                    <i class="fa-solid fa-chevron-down text-gray-400 text-xs transition group-open:rotate-180"></i>
                </summary>
                <div class="p-4 text-sm text-gray-600 leading-relaxed bg-white border-t border-gray-50">
                    {!! nl2br(e($product->delivery_info ?? 'Tersedia pengiriman ke berbagai area sesuai jangkauan logistik.')) !!}
                </div>
            </details>
        </div>
    </div>
    </div>
</section>

<!-- Related Products -->
<section class="bg-bg-soft-pink py-12 md:py-16">
    <div class="container mx-auto px-4">
    <h3 class="text-2xl font-serif text-center text-gray-800 mb-10">Mungkin Anda Juga Suka<i class="fa-solid fa-fan text-brand-pink text-sm ml-2"></i></h3>

    @if($relatedProducts->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
        @foreach($relatedProducts as $rel)
        <a href="{{ url('/product-detail?id=' . $rel->id) }}" class="block bg-white p-3 rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] transition-transform hover:-translate-y-1">
            <div class="bg-bg-soft-green rounded-lg mb-3 flex items-center justify-center overflow-hidden aspect-[4/3] w-full">
            @if($rel->image_path)
                <img src="{{ Storage::url($rel->image_path) }}" alt="{{ $rel->name }}" class="w-full h-full object-cover" />
            @else
                <i class="fa-solid fa-image text-4xl text-gray-400"></i>
            @endif
            </div>
            <h4 class="font-medium text-sm text-gray-800 mb-1 truncate">{{ $rel->name }}</h4>
            <p class="text-brand-green font-semibold text-sm">Rp{{ number_format($rel->price, 0, ',', '.') }}</p>
        </a>
        @endforeach
    </div>
    @else
    <p class="text-center text-gray-500 text-sm">Belum ada produk terkait di kategori yang sama.</p>
    @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const thumbnails = document.querySelectorAll(".thumbnail");
        const mainImg = document.getElementById("main-product-img");
        if (thumbnails.length > 0 && mainImg) {
            thumbnails.forEach((th) => {
                th.addEventListener("click", (e) => {
                    thumbnails.forEach((t) => t.classList.remove("active", "ring-2", "ring-brand-pink", "border-brand-pink"));
                    e.target.classList.add("active", "ring-2", "ring-brand-pink", "border-brand-pink");
                    mainImg.src = e.target.src; 
                });
            });
        }
    });
</script>
@endpush
