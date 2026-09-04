@extends('layouts.app')
@section('title', 'Hubungi Kami - Fania Flower Shop')

@section('content')
<!-- Page Header -->
<div class="bg-bg-soft-pink py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-serif text-brand-green mb-4">Hubungi Kami</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Punya pertanyaan, pesanan khusus, atau ingin berkolaborasi? Kami di sini siap membantu Anda.</p>
    </div>
</div>

<section class="py-12 pb-24">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-6">
            
            <!-- Contact Form Card -->
            <div class="w-full md:w-1/2 bg-bg-soft-pink rounded-[2rem] p-8 md:p-10 relative shadow-soft-pink">
                <h3 class="text-2xl font-serif text-brand-green mb-6 flex items-center gap-2">Hubungi Kami <i class="fa-solid fa-envelope-open-text text-brand-pink text-sm"></i></h3>
                
                <div class="relative z-10 w-full flex flex-col gap-4 mt-2">
                    <div class="flex items-start gap-4 bg-white/60 p-4 rounded-xl border border-white/40 shadow-[0_4px_10px_rgba(0,0,0,0.02)]">
                        <div class="w-10 h-10 rounded-full bg-brand-green text-white flex items-center justify-center shrink-0">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 text-sm mb-1">WhatsApp 1</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">+{{ $settings['whatsapp_number'] ?? '6281234567890' }}</p>
                        </div>
                    </div>

                    @if(!empty($settings['whatsapp_number_2']))
                    <div class="flex items-start gap-4 bg-white/60 p-4 rounded-xl border border-white/40 shadow-[0_4px_10px_rgba(0,0,0,0.02)]">
                        <div class="w-10 h-10 rounded-full bg-brand-green text-white flex items-center justify-center shrink-0">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 text-sm mb-1">WhatsApp 2</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">+{{ $settings['whatsapp_number_2'] }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="flex items-start gap-4 bg-white/60 p-4 rounded-xl border border-white/40 shadow-[0_4px_10px_rgba(0,0,0,0.02)]">
                        <div class="w-10 h-10 rounded-full bg-brand-green text-white flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 text-sm mb-1">Email</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">{{ $settings['email'] ?? 'halo@faniaflowershop.com' }}</p>
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
                    {!! nl2br(e($settings['company_address'] ?? "Jl. Bunga Indah No. 10\nKebayoran Baru, Jakarta Selatan 12120")) !!}
                </p>
                
                <!-- Map Mockup -->
                <div class="w-full flex-1 min-h-[200px] bg-gray-200 rounded-xl overflow-hidden relative border border-gray-100 shadow-inner">
                    @php 
                        $embedMap = $settings['company_map_embed'] ?? ''; 
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
                            <span class="text-xs font-semibold text-gray-800">{{ $settings['company_pin_label'] ?? 'Fania Flower Shop' }}</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Map Location" class="w-full h-full object-cover opacity-60" />
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
