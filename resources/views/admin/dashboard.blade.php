@extends('layouts.admin')
@section('title', 'Dashboard')
@section('header_title', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-brand-green/10 text-brand-green flex items-center justify-center text-xl shrink-0">
            <i class="fa-solid fa-box-open"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium mb-0.5">Products</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</h3>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center text-xl shrink-0">
            <i class="fa-solid fa-layer-group"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium mb-0.5">Categories</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $totalCategories }}</h3>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-brand-pink/10 text-brand-pink flex items-center justify-center text-xl shrink-0">
            <i class="fa-regular fa-envelope"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium mb-0.5">New Msgs</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $unreadMessages }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center text-xl shrink-0">
            <i class="fa-solid fa-users"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium mb-0.5">Today Hits</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $todayVisitors }}</h3>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center text-xl shrink-0">
            <i class="fa-solid fa-chart-line"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium mb-0.5">Month Hits</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $monthlyVisitors }}</h3>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
    <h3 class="text-lg font-serif text-brand-green mb-4">Welcome back, Admin!</h3>
    <p class="text-gray-600 text-sm leading-relaxed max-w-2xl">
        Dari halaman ini Anda dapat mengatur ketersediaan produk bunga yang tampil di halaman utama kepada para pelanggan. 
        Meskipun pemesanan hanya dilakukan melalui WhatsApp, pastikan harga dan daftar produk selalu sinkron agar pelanggan mendapatkan informasi yang akurat.
    </p>
</div>
@endsection
