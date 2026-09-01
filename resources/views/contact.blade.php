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

<section class="container mx-auto px-4 py-16">
    <div class="flex justify-center">
        <!-- Info Khusus -->
        <div class="w-full md:w-1/2">
            <div class="bg-white p-8 rounded-2xl shadow-soft border border-gray-100 text-center">
                <h3 class="text-2xl font-serif text-brand-green mb-8">Informasi Kontak</h3>
                
                <div class="flex flex-col items-center gap-2 mb-6">
                    <div class="w-12 h-12 rounded-full bg-bg-soft-green text-brand-green flex items-center justify-center mb-2">
                        <i class="fa-brands fa-whatsapp text-xl"></i>
                    </div>
                    <h4 class="font-medium text-gray-800 text-lg">WhatsApp</h4>
                    <p class="text-gray-600 text-sm">CS 1: +{{ $settings['whatsapp_number'] ?? '6281234567890' }}</p>
                    @if(!empty($settings['whatsapp_number_2']))
                    <p class="text-gray-600 text-sm">CS 2: +{{ $settings['whatsapp_number_2'] }}</p>
                    @endif
                </div>

                <div class="flex flex-col items-center gap-2 mb-8">
                    <div class="w-12 h-12 rounded-full bg-bg-soft-green text-brand-green flex items-center justify-center mb-2">
                        <i class="fa-solid fa-envelope text-xl"></i>
                    </div>
                    <h4 class="font-medium text-gray-800 text-lg">Email</h4>
                    <p class="text-gray-600 text-sm">{{ $settings['email'] ?? 'halo@faniaflowershop.com' }}</p>
                </div>
                
                <div class="border-t border-gray-100 pt-8 mt-2">
                    <h4 class="font-medium text-gray-800 text-lg mb-4"><i class="fa-solid fa-map-location-dot text-brand-green mr-2"></i>Peta & Lokasi</h4>
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">{!! nl2br(e($settings['company_address'] ?? "Jl. Bunga Melati No. 42,\nKebayoran Baru, Jakarta Selatan")) !!}</p>
                    
                    @php
                        $rawMap = $settings['company_map_embed'] ?? '';
                        $mapUrl = '';
                        if (str_contains($rawMap, 'src="')) {
                            preg_match('/src="([^"]+)"/', $rawMap, $match);
                            $mapUrl = $match[1] ?? '';
                        } else {
                            $mapUrl = $rawMap;
                        }
                        if (empty($mapUrl)) {
                            $mapUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.2403271501!2d106.75936301323985!3d-6.229740131114092!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f8e853d2e38d%3A0x301576d14feb9e0!2sJakarta%20Selatan%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid";
                        }
                    @endphp
                    <div class="rounded-xl overflow-hidden shadow-inner border border-gray-200">
                        <iframe src="{{ $mapUrl }}" class="w-full h-72" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
