@extends('layouts.app')
@section('title', 'Beranda - Fania Flower Shop')

@section('content')
<!-- Hero Section -->
<section class="relative bg-bg-soft-pink pt-12 pb-20 md:pt-20 md:pb-32 overflow-hidden">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center relative z-10">
        <!-- Text Content -->
        <div class="w-full md:w-1/2 flex flex-col items-start text-left mb-10 md:mb-0">
            <h1 class="text-3xl md:text-5xl font-serif text-brand-green mb-4 leading-tight">
                {{ \App\Models\Setting::where('key', 'hero_title_1')->value('value') ?? 'Kirim Bunga,' }}<br>
                <span class="text-brand-pink italic">{{ \App\Models\Setting::where('key', 'hero_title_2')->value('value') ?? 'Sampaikan Perasaan' }}</span> <i class="fa-solid fa-seedling text-brand-pink text-2xl md:text-4xl"></i>
            </h1>
            <p class="text-gray-600 text-base md:text-lg mb-8 max-w-sm mt-4">
                {{ \App\Models\Setting::where('key', 'hero_subtitle')->value('value') ?? 'Buket segar pilihan untuk setiap momen spesial dalam hidup Anda.' }}
            </p>
            <a href="{{ url('/catalogue') }}" class="inline-flex items-center gap-2 bg-brand-green text-white px-8 py-3 rounded-full font-medium hover:bg-opacity-90 transition shadow-md">
                Lihat Catalogue <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>
            <!-- Decorative Leaves Bottom Left -->
            <img src="https://images.unsplash.com/photo-1597826336103-f661aee093f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" class="absolute -bottom-20 -left-10 w-40 opacity-30 mix-blend-multiply rounded-full" alt="" style="clip-path: circle(50%);" />
        </div>
        
        <!-- Hero Image -->
        <div class="w-full md:w-1/2 relative">
            <div class="relative w-full aspect-square md:aspect-[4/3] rounded-[3rem] overflow-hidden shadow-2xl">
                @php $heroImg = \App\Models\Setting::where('key', 'hero_image_path')->value('value'); @endphp
                <img src="{{ $heroImg ? Storage::url($heroImg) : 'https://images.unsplash.com/photo-1563241527-3004b7be0ffd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80' }}" alt="Beautiful Bouquet" class="w-full h-full object-cover origin-center" />
            </div>
            <!-- Decorative blur shape -->
            <div class="absolute -z-10 bg-brand-pink-light blur-3xl w-full h-full rounded-full top-10 left-10 opacity-30"></div>
        </div>
    </div>
</section>

<!-- Jenis Bunga Section -->
<section class="py-12 md:py-16">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-center gap-4 mb-10 text-brand-green opacity-70">
            <i class="fa-solid fa-leaf transform -scale-x-100"></i>
            <h2 class="text-xl md:text-2xl font-serif text-center">Jenis Bunga yang Tersedia</h2>
            <i class="fa-solid fa-leaf"></i>
        </div>
        
        <div class="flex overflow-x-auto no-scrollbar gap-4 md:gap-6 justify-start md:justify-center pb-4">
            <!-- Items -->
            @foreach ($categories as $f)
            <div class="flex flex-col items-center gap-3 shrink-0 group cursor-pointer">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-bg-soft-pink rounded-2xl flex items-center justify-center p-2 group-hover:shadow-soft-pink transition-all">
                    @if($f->image_path)
                        <img src="{{ Storage::url($f->image_path) }}" class="w-full h-full object-cover rounded-xl" alt="{{ $f->name }}">
                    @else
                        <i class="fa-solid fa-layer-group text-brand-pink text-2xl"></i>
                    @endif
                </div>
                <span class="text-xs md:text-sm text-gray-600 font-medium group-hover:text-brand-pink transition">{{ $f->name }}</span>
            </div>
            @endforeach
            <!-- Others -->
            <div class="flex flex-col items-center gap-3 shrink-0 group cursor-pointer">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-bg-soft-pink rounded-2xl flex items-center justify-center p-4 group-hover:shadow-soft-pink transition-all border border-pink-100">
                    <div class="grid grid-cols-2 gap-1 w-full h-full">
                        <div class="border border-brand-pink rounded-sm"></div>
                        <div class="border border-brand-pink rounded-sm"></div>
                        <div class="border border-brand-pink rounded-sm"></div>
                        <div class="border border-brand-pink rounded-sm"></div>
                    </div>
                </div>
                <span class="text-xs md:text-sm text-gray-600 font-medium group-hover:text-brand-pink transition">Lainnya</span>
            </div>
        </div>
    </div>
</section>

<!-- Catalogue Section -->
<section class="py-12 md:py-16">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-serif text-brand-green flex items-center gap-2">Catalogue <i class="fa-solid fa-fan text-brand-pink text-sm"></i></h2>
                <p class="text-gray-500 text-sm mt-2 max-w-sm">Temukan berbagai rangkaian bunga cantik untuk setiap kesempatan.</p>
            </div>
            <a href="{{ url('/catalogue') }}" class="px-5 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 font-medium hover:bg-gray-50 transition w-full md:w-auto text-center">
                Lihat Semua Catalogue <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 md:gap-5">
            @foreach ($products as $index => $item)
            <div class="bg-white rounded-2xl p-3 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50 flex flex-col group {{ $index > 1 ? 'hidden md:flex' : 'flex' }} {{ $index > 1 && $index < 4 ? 'hidden md:flex' : 'flex' }}">
                <div class="bg-bg-soft-green flex items-center justify-center rounded-xl mb-3 overflow-hidden aspect-[4/3]">
                    @if($item->image_path)
                        <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
                    @else
                        <i class="fa-solid fa-image text-4xl text-gray-300"></i>
                    @endif
                </div>
                <h4 class="font-serif text-sm md:text-base text-gray-800 mb-1 truncate">{{ $item->name }}</h4>
                <p class="text-brand-green font-semibold text-xs md:text-sm mb-3">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                <a href="{{ url('/product-detail?id=' . $item->id) }}" class="mt-auto block text-center bg-brand-pink text-white w-full py-2 rounded-lg text-xs md:text-sm font-medium hover:bg-opacity-90 transition">
                    Lihat Detail
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-12 md:py-16 bg-white">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-serif text-brand-green flex items-center gap-2">Gallery <i class="fa-solid fa-fan text-brand-pink text-sm"></i></h2>
                <p class="text-gray-500 text-sm mt-2 max-w-sm">Lihat beberapa momen indah dari rangkaian bunga yang telah kami buat.</p>
            </div>
            <a href="{{ url('/gallery') }}" class="px-5 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 font-medium hover:bg-gray-50 transition w-full md:w-auto text-center">
                Lihat Gallery Lebih Lengkap <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 md:gap-5 items-start">
            @foreach ($galleries as $index => $item)
            <div class="flex flex-col {{ $index > 1 ? 'hidden md:flex' : 'flex' }}">
                <div class="relative w-full rounded-2xl overflow-hidden mb-3 group shadow-soft">
                    @if($item->image_path)
                        <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}" class="w-full h-auto block group-hover:scale-105 transition duration-500" />
                        <!-- Play icon overlay -->
                        <div class="absolute top-2 left-2 bg-white/80 backdrop-blur-sm w-6 h-6 rounded-full flex items-center justify-center text-[10px] text-gray-700">
                            <i class="fa-solid fa-camera ml-0.5"></i>
                        </div>
                    @else
                        <div class="w-full aspect-[4/3] flex items-center justify-center bg-gray-100">
                            <i class="fa-solid fa-image text-3xl text-gray-300"></i>
                        </div>
                    @endif
                </div>
                <h5 class="text-center text-gray-700 text-xs md:text-sm font-medium">{{ $item->title }}</h5>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact & Map Cards Section -->
<section class="py-12 pb-24">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-6">
            
            <!-- Contact Form Card -->
            <div class="w-full md:w-1/2 bg-bg-soft-pink rounded-[2rem] p-8 md:p-10 relative shadow-soft-pink">
                <h3 class="text-2xl font-serif text-brand-green mb-6 flex items-center gap-2">Contact Us <i class="fa-solid fa-envelope-open-text text-brand-pink text-sm"></i></h3>
                
                <div class="relative z-10 w-full flex flex-col gap-4 mt-2">
                    <div class="flex items-start gap-4 bg-white/60 p-4 rounded-xl border border-white/40 shadow-[0_4px_10px_rgba(0,0,0,0.02)]">
                        <div class="w-10 h-10 rounded-full bg-brand-green text-white flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-map-marker-alt text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 text-sm mb-1">Alamat</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">{!! nl2br(e(\App\Models\Setting::where('key', 'company_address')->value('value') ?? "Jl. Bunga Melati No. 42,\nKebayoran Baru, Jakarta Selatan")) !!}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 bg-white/60 p-4 rounded-xl border border-white/40 shadow-[0_4px_10px_rgba(0,0,0,0.02)]">
                        <div class="w-10 h-10 rounded-full bg-brand-green text-white flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-phone text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 text-sm mb-1">Telepon / WhatsApp</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">+{{ \App\Models\Setting::where('key', 'whatsapp_number')->value('value') ?? '6281234567890' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 bg-white/60 p-4 rounded-xl border border-white/40 shadow-[0_4px_10px_rgba(0,0,0,0.02)]">
                        <div class="w-10 h-10 rounded-full bg-brand-green text-white flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 text-sm mb-1">Email</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">halo@faniaflowershop.com</p>
                        </div>
                    </div>
                </div>

                <!-- Decorative flower outline -->
                <img src="https://images.unsplash.com/photo-1597826336103-f661aee093f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" class="absolute bottom-0 right-0 w-48 opacity-10 mix-blend-multiply filter grayscale rounded-tl-[100px] pointer-events-none z-0" alt="" style="clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);" />
            </div>

            <!-- Alamat Kami Card -->
            <div class="w-full md:w-1/2 bg-bg-soft-green rounded-[2rem] p-8 md:p-10 relative overflow-hidden shadow-soft flex flex-col">
                <h3 class="text-2xl font-serif text-brand-green mb-3 flex items-center gap-2">Alamat Kami <i class="fa-solid fa-leaf text-brand-green opacity-50 text-sm"></i></h3>
                <p class="text-gray-600 text-sm mb-5 leading-relaxed font-medium">
                    {!! nl2br(e(\App\Models\Setting::where('key', 'company_address')->value('value') ?? "Jl. Bunga Indah No. 10\nKebayoran Baru, Jakarta Selatan 12120")) !!}
                </p>
                
                <!-- Map Mockup -->
                <div class="w-full flex-1 min-h-[200px] bg-gray-200 rounded-xl overflow-hidden relative border border-gray-100 shadow-inner">
                    @php 
                        $embedMap = \App\Models\Setting::where('key', 'company_map_embed')->value('value'); 
                        if ($embedMap && preg_match('/src="([^"]+)"/', $embedMap, $matches)) {
                            $embedMap = $matches[1];
                        }
                    @endphp
                    @if($embedMap)
                        <iframe src="{{ $embedMap }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @else
                        <!-- Pin Fallback (Empty Map) -->
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center gap-2 bg-white px-3 py-1.5 rounded-full shadow-lg z-10 w-max max-w-full">
                            <i class="fa-solid fa-location-dot text-brand-pink"></i>
                            <span class="text-xs font-semibold text-gray-800">{{ \App\Models\Setting::where('key', 'company_pin_label')->value('value') ?? 'Fania Flower Shop' }}</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Map Location" class="w-full h-full object-cover opacity-60" />
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
