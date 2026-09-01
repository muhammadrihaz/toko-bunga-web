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
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
        @foreach($galleries as $gallery)
        @php
            $ext = strtolower(pathinfo($gallery->image_path, PATHINFO_EXTENSION));
            $isVideo = in_array($ext, ['mp4', 'webm', 'ogg', 'mov']);
        @endphp
        <div class="rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] cursor-pointer group relative bg-gray-100 aspect-square" onclick="openLightbox('{{ Storage::url($gallery->image_path) }}', {{ $isVideo ? 'true' : 'false' }}, '{{ $gallery->title ?? '' }}')">
            @if($isVideo)
                <video src="{{ Storage::url($gallery->image_path) }}" class="w-full h-full object-cover block group-hover:scale-105 transition duration-500"></video>
                <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/10 transition">
                    <i class="fa-solid fa-play text-white text-3xl opacity-80 shadow-sm"></i>
                </div>
            @else
                <img src="{{ Storage::url($gallery->image_path) }}" class="w-full h-full object-cover block group-hover:scale-105 transition duration-500" alt="{{ $gallery->title ?? 'Gallery Image' }}" />
            @endif
            
            @if($gallery->title)
            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 opacity-0 group-hover:opacity-100 transition duration-300">
                <p class="text-white font-medium text-xs md:text-sm translate-y-2 group-hover:translate-y-0 transition truncate">{{ $gallery->title }}</p>
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

    @php $gDriveLink = \App\Models\Setting::where('key', 'google_drive_link')->value('value'); @endphp
    @if($gDriveLink)
    <div class="mt-16 text-center">
        <a href="{{ $gDriveLink }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-white text-brand-green border border-brand-green px-8 py-3.5 rounded-full font-semibold hover:bg-brand-green hover:text-white transition shadow-sm hover:shadow-md">
            <i class="fa-brands fa-google-drive text-lg"></i> Lihat Galeri Keseluruhan
        </a>
    </div>
    @endif
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 z-[100] bg-black/90 hidden items-center justify-center p-4 md:p-10 opacity-0 transition-opacity duration-300">
    <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white text-3xl hover:text-gray-300 transition z-10 w-12 h-12 flex items-center justify-center bg-black/20 rounded-full">
        <i class="fa-solid fa-times"></i>
    </button>
    
    <div class="relative w-full max-w-4xl max-h-[85vh] flex flex-col items-center justify-center">
        <div id="lightbox-content" class="w-full h-full flex items-center justify-center relative">
            <!-- Image or Video will be injected here -->
        </div>
        <p id="lightbox-caption" class="text-white text-center mt-4 text-lg font-medium hidden"></p>
    </div>
</div>

@push('scripts')
<script>
    const lightbox = document.getElementById('lightbox');
    const lightboxContent = document.getElementById('lightbox-content');
    const lightboxCaption = document.getElementById('lightbox-caption');

    function openLightbox(url, isVideo, title) {
        // Clear previous content
        lightboxContent.innerHTML = '';
        
        if (isVideo) {
            lightboxContent.innerHTML = `<video src="${url}" controls autoplay class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl"></video>`;
        } else {
            lightboxContent.innerHTML = `<img src="${url}" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl" alt="${title}">`;
        }

        if (title) {
            lightboxCaption.textContent = title;
            lightboxCaption.classList.remove('hidden');
        } else {
            lightboxCaption.classList.add('hidden');
        }

        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        
        // Slight delay to allow display:flex to apply before animating opacity
        setTimeout(() => {
            lightbox.classList.remove('opacity-0');
            lightbox.classList.add('opacity-100');
        }, 10);

        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    function closeLightbox() {
        lightbox.classList.remove('opacity-100');
        lightbox.classList.add('opacity-0');
        
        setTimeout(() => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            lightboxContent.innerHTML = ''; // Stop video if playing
            document.body.style.overflow = '';
        }, 300);
    }

    // Close on click outside
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox || e.target.closest('#lightbox > div') === null) {
            closeLightbox();
        }
    });

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !lightbox.classList.contains('hidden')) {
            closeLightbox();
        }
    });
</script>
@endpush
@endsection
