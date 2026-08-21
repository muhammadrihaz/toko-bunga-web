@extends('layouts.app')
@section('title', 'Tentang Kami - Fania Flower Shop')

@section('content')
<!-- Page Header -->
<div class="bg-bg-soft-green py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-serif text-brand-green mb-4">{{ $settings['about_title'] ?? 'Tentang Fania Flower Shop' }}</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">{{ $settings['about_subtitle'] ?? 'Kami merangkai cerita dan perasaan menjadi seikat bunga yang indah merona.' }}</p>
    </div>
</div>

<section class="container mx-auto px-4 py-16">
    <div class="flex flex-col md:flex-row items-center gap-12">
        <div class="w-full md:w-1/2">
            @php $aboutImg = $settings['about_image_path'] ?? null; @endphp
            @if($aboutImg)
                <img src="{{ Storage::url($aboutImg) }}" alt="Florist at work" class="rounded-2xl shadow-soft block w-full h-[400px] object-cover" />
            @else
                <img src="https://images.unsplash.com/photo-1579698305607-b3ba620e2e2a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Florist at work" class="rounded-2xl shadow-soft block w-full h-[400px] object-cover" />
            @endif
        </div>
        <div class="w-full md:w-1/2">
            <h2 class="text-3xl font-serif text-brand-green mb-6">{{ $settings['about_story_title'] ?? 'Mekar dengan Cinta Sejak 2018' }}</h2>
            <div class="text-gray-600 mb-8 leading-relaxed">
                {!! nl2br(e($settings['about_story_content'] ?? "Berawal dari kecintaan kami terhadap keindahan alam, Fania Flower Shop hadir untuk menjadi jembatan pesan hati melalui bunga. Kami percaya bahwa setiap tangkai bunga memiliki makna dan energinya sendiri.\n\nFlorist kami selalu menggunakan bunga segar langsung dari petani lokal terbaik, dipadukan dengan kertas bungkus premium import, dan dirangkai penuh ketelitian.")) !!}
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h3 class="text-3xl font-bold text-brand-pink mb-2">{{ $settings['about_stat_1_value'] ?? '5,000+' }}</h3>
                    <p class="text-gray-500 text-sm">{{ $settings['about_stat_1_text'] ?? 'Buket Terkirim' }}</p>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-brand-pink mb-2">{{ $settings['about_stat_2_value'] ?? '100%' }}</h3>
                    <p class="text-gray-500 text-sm">{{ $settings['about_stat_2_text'] ?? 'Kesegaran Terjamin' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
