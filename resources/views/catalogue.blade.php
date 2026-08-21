@extends('layouts.app')
@section('title', 'Katalog Produk - Fania Flower Shop')

@section('content')
<!-- Page Header -->
<div class="bg-bg-soft-green py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-serif text-brand-green mb-4">Katalog Kami</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Temukan koleksi buket dan karangan bunga terbaik untuk setiap orang yang Anda cintai. Dibuat dengan penuh dedikasi oleh florist berpengalaman.</p>
    </div>
</div>

<!-- Filters -->
<div class="bg-white border-b border-gray-100">
    <div class="container mx-auto px-4 py-4">
        <div class="flex flex-col gap-6">
            <!-- Search Form -->
            <form action="{{ url('/catalogue') }}" method="GET" class="w-full relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama bunga..." class="w-full pl-12 pr-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-brand-pink shadow-sm transition bg-white text-sm">
                <i class="fa-solid fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <button type="submit" class="hidden"></button>
            </form>
            
            <!-- Category Pills -->
            <div class="flex overflow-x-auto no-scrollbar gap-2 pb-2">
                <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="px-5 py-2.5 rounded-full text-sm font-medium whitespace-nowrap transition-colors {{ !request('category') ? 'bg-brand-green text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Semua Kategori</a>
                @foreach($categories as $cat)
                    <a href="{{ request()->fullUrlWithQuery(['category' => $cat->id]) }}" class="px-5 py-2.5 rounded-full text-sm font-medium whitespace-nowrap transition-colors {{ request('category') == $cat->id ? 'bg-brand-green text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">{{ $cat->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Product Grid -->
<section class="container mx-auto px-4 py-12">
    @if($products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($products as $item)
            <div class="bg-white p-3 md:p-4 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 transition-transform group hover:-translate-y-1 relative overflow-hidden flex flex-col h-full">
                <div class="bg-bg-soft-green flex items-center justify-center rounded-xl mb-3 md:mb-4 overflow-hidden aspect-[4/3] w-full">
                    @if($item->image_path)
                        <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
                    @else
                        <i class="fa-solid fa-image text-4xl text-gray-300"></i>
                    @endif
                </div>
                <!-- Category Badge -->
                @if($item->category)
                    <div class="absolute top-5 left-5 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-md text-[10px] font-medium text-brand-green border border-white shadow-sm">
                        {{ $item->category->name }}
                    </div>
                @endif
                <h4 class="text-sm md:text-base font-serif text-gray-800 mb-1 truncate">{{ $item->name }}</h4>
                <p class="text-brand-green font-semibold text-xs md:text-sm mb-4">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                <a href="{{ url('/product-detail?id=' . $item->id) }}" class="mt-auto block text-center bg-brand-pink text-white w-full py-2.5 rounded-lg text-xs md:text-sm font-medium hover:bg-opacity-90 transition mt-auto">
                    Lihat Detail
                </a>
            </div>
            @endforeach
        </div>
        
        <div class="mt-12 flex justify-center">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-20 bg-gray-50 rounded-3xl mt-4">
            <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-3"></i>
            <h3 class="text-lg font-serif text-gray-700">Tidak ada produk ditemukan</h3>
            <p class="text-gray-500 text-sm mt-1">Coba gunakan kata kunci lain atau ubah kategori filter Anda.</p>
            <a href="{{ url('/catalogue') }}" class="inline-block mt-4 text-brand-pink hover:underline text-sm font-medium">Reset Pencarian</a>
        </div>
    @endif
</section>
@endsection
