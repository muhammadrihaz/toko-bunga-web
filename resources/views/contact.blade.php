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
    <div class="flex flex-col md:flex-row gap-12">
        <!-- Info Khusus -->
        <div class="w-full md:w-1/3">
            <div class="bg-white p-8 rounded-2xl shadow-soft">
                <h3 class="text-xl font-serif text-brand-green mb-6">Informasi Kontak</h3>
                
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-10 h-10 rounded-full bg-bg-soft-green text-brand-green flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800 mb-1">Alamat</h4>
                        <p class="text-sm text-gray-500">{!! nl2br(e($settings['company_address'] ?? "Jl. Bunga Melati No. 42,\nKebayoran Baru, Jakarta Selatan")) !!}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 mb-6">
                    <div class="w-10 h-10 rounded-full bg-bg-soft-green text-brand-green flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800 mb-1">Telepon / WhatsApp</h4>
                        <p class="text-sm text-gray-500">+{{ $settings['whatsapp_number'] ?? '6281234567890' }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-bg-soft-green text-brand-green flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800 mb-1">Email</h4>
                        <p class="text-sm text-gray-500">halo@faniaflowershop.com</p>
                    </div>
                </div>
                
                <div class="mt-8 border-t border-gray-100 pt-6">
                    <h4 class="font-medium text-gray-800 mb-3">Peta Lokasi</h4>
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
                    <iframe src="{{ $mapUrl }}" class="w-full h-56 rounded-xl border border-gray-100" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

        <!-- Form Konten -->
        <div class="w-full md:w-2/3">
            <form action="{{ route('contact.send') }}" method="POST" class="bg-white p-8 rounded-2xl shadow-soft">
                @csrf
                <h3 class="text-xl font-serif text-brand-green mb-6">Kirim Pesan</h3>
                
                @if(session('success'))
                    <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition" placeholder="Nama Anda" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition" placeholder="email@contoh.com" />
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pesan Anda</label>
                    <textarea name="message" required rows="5" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition" placeholder="Tulis pesan Anda di sini..."></textarea>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Berapa hasil dari {{ $num1 }} + {{ $num2 }}? (Anti-Spam)</label>
                    <input type="number" name="captcha" required class="w-24 px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition">
                    @error('captcha')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <button type="submit" class="bg-brand-green text-white px-8 py-3 rounded-full font-medium hover:bg-opacity-90 transition shadow-md w-full md:w-auto">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
