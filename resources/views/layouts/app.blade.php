<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Fania Flower Shop')</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/logo.jpeg') }}" type="image/jpeg">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', 'Fania Flower Shop')" />
    <meta property="og:description" content="@yield('og_description', 'Toko Bunga Fania Flower Shop')" />
    <meta property="og:image" content="@yield('og_image', asset('assets/logo.jpeg'))" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              "brand-green": "#516553",
              "brand-pink": "#e595a0",
              "brand-pink-light": "#f5b5bd",
              "bg-soft-pink": "#fdf6f6",
              "bg-soft-green": "#eff2ef",
            },
            fontFamily: {
              serif: ['"Playfair Display"', "serif"],
              sans: ['"Poppins"', "sans-serif"],
            },
            boxShadow: {
              soft: "0 8px 24px rgba(81, 101, 83, 0.08)",
              "soft-pink": "0 10px 28px rgba(229, 149, 160, 0.18)",
              "glow-pink": "0 0 20px rgba(229, 149, 160, 0.25)",
              "glow-green": "0 0 20px rgba(81, 101, 83, 0.2)",
            },
          },
        },
      };
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
      body {
        font-family: "Poppins", sans-serif;
        background: #ffffff;
      }
      h1, h2, h3, .font-serif {
        font-family: "Playfair Display", serif;
      }
      header {
        transition: box-shadow 300ms ease-in-out, background-color 300ms ease-in-out;
      }
      header:hover {
        box-shadow: 0 6px 24px rgba(81, 101, 83, 0.06);
      }
      nav a, footer a {
        transition: color 300ms ease-in-out, opacity 300ms ease-in-out;
      }
      nav a:hover, footer a:hover {
        opacity: 0.8;
      }
      button, a {
        transition: color 300ms ease-in-out, background-color 300ms ease-in-out, border-color 300ms ease-in-out, box-shadow 300ms ease-in-out, transform 300ms ease-in-out, opacity 300ms ease-in-out;
      }
      button:not(.nav-arrow):hover {
        transform: translateY(-2px);
      }
      button:active {
        transform: translateY(0);
      }
      header img {
        transition: transform 300ms ease-in-out, box-shadow 300ms ease-in-out;
      }
      header img:hover {
        transform: scale(1.08);
        box-shadow: 0 0 12px rgba(229, 149, 160, 0.35);
      }
      .thumbnail {
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 300ms ease-in-out;
        opacity: 0.7;
      }
      .thumbnail:hover, .thumbnail.active {
        border-color: #e595a0;
        opacity: 1;
      }
    </style>
</head>

<body class="text-gray-800 bg-white">
    <!-- Header / Navbar -->
    <header class="container mx-auto px-4 py-4 flex justify-between items-center z-50 bg-white sticky top-0">
      <div class="flex items-center gap-2">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
          <img src="{{ asset('assets/erasebg-transformed.png') }}" alt="Fania Flower Shop Logo" class="h-10 md:h-12 w-auto object-contain" />
          <span class="font-serif text-xl md:text-2xl font-bold text-brand-green">Fania Flower Shop</span>
        </a>
      </div>

      <nav class="hidden md:flex gap-8 text-sm font-medium">
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'border-b-2 border-brand-green pb-1 text-gray-800' : 'text-gray-500 hover:text-brand-green transition' }}">Beranda</a>
        <a href="{{ url('/catalogue') }}" class="{{ request()->is('catalogue*') ? 'border-b-2 border-brand-green pb-1 text-gray-800' : 'text-gray-500 hover:text-brand-green transition' }}">Catalogue</a>
        <a href="{{ url('/gallery') }}" class="{{ request()->is('gallery*') ? 'border-b-2 border-brand-green pb-1 text-gray-800' : 'text-gray-500 hover:text-brand-green transition' }}">Gallery</a>
        <a href="{{ url('/about') }}" class="{{ request()->is('about*') ? 'border-b-2 border-brand-green pb-1 text-gray-800' : 'text-gray-500 hover:text-brand-green transition' }}">Tentang Kami</a>
        <a href="{{ url('/contact') }}" class="{{ request()->is('contact*') ? 'border-b-2 border-brand-green pb-1 text-gray-800' : 'text-gray-500 hover:text-brand-green transition' }}">Contact</a>
      </nav>

      <div class="flex items-center gap-4">
        <button id="hamburgerBtn" class="md:hidden text-2xl text-gray-700 nav-arrow">
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div id="mobileMenu" class="fixed inset-0 bg-white z-[60] flex flex-col pt-6 px-6 transform translate-x-full transition-transform duration-300 md:hidden shadow-2xl">
      <div class="flex justify-between items-center mb-10">
        <img src="{{ asset('assets/erasebg-transformed.png') }}" alt="Fania Flower Shop" class="h-10 w-auto object-contain" />
        <button id="closeMobileMenu" class="text-2xl text-gray-700 p-2">
          <i class="fa-solid fa-times"></i>
        </button>
      </div>
      <nav class="flex flex-col gap-6 text-lg font-medium">
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-brand-pink font-semibold' : 'text-gray-800' }}">Beranda</a>
        <a href="{{ url('/catalogue') }}" class="{{ request()->is('catalogue*') ? 'text-brand-pink font-semibold' : 'text-gray-800' }}">Catalogue</a>
        <a href="{{ url('/gallery') }}" class="{{ request()->is('gallery*') ? 'text-brand-pink font-semibold' : 'text-gray-800' }}">Gallery</a>
        <a href="{{ url('/about') }}" class="{{ request()->is('about*') ? 'text-brand-pink font-semibold' : 'text-gray-800' }}">Tentang Kami</a>
        <a href="{{ url('/contact') }}" class="{{ request()->is('contact*') ? 'text-brand-pink font-semibold' : 'text-gray-800' }}">Contact</a>
      </nav>
    </div>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-brand-green text-white py-8">
      <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex flex-wrap justify-center md:justify-start gap-4 md:gap-8 text-sm text-gray-200 md:flex-grow">
          <a href="{{ url('/') }}" class="hover:text-white transition">Beranda</a>
          <a href="{{ url('/catalogue') }}" class="hover:text-white transition">Catalogue</a>
          <a href="{{ url('/gallery') }}" class="hover:text-white transition">Gallery</a>
          <a href="{{ url('/about') }}" class="hover:text-white transition">Tentang Kami</a>
          <a href="{{ url('/contact') }}" class="hover:text-white transition">Contact</a>
        </div>
        <div class="flex gap-4 justify-center">
          <a href="{{ \App\Models\Setting::where('key', 'social_instagram')->value('value') ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full border border-gray-400 flex items-center justify-center hover:bg-white hover:text-brand-green transition"><i class="fa-brands fa-instagram"></i></a>
          <a href="{{ \App\Models\Setting::where('key', 'social_tiktok')->value('value') ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full border border-gray-400 flex items-center justify-center hover:bg-white hover:text-brand-green transition"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="currentColor"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg></a>
          <a href="{{ \App\Models\Setting::where('key', 'social_facebook')->value('value') ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full border border-gray-400 flex items-center justify-center hover:bg-white hover:text-brand-green transition"><i class="fa-brands fa-facebook-f"></i></a>
        </div>
      </div>
    </footer>

    <!-- Scripts -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Mobile Menu Logic
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const closeMobileMenuBtn = document.getElementById('closeMobileMenu');
        const mobileMenu = document.getElementById('mobileMenu');

        if (hamburgerBtn && closeMobileMenuBtn && mobileMenu) {
          hamburgerBtn.addEventListener('click', function() {
            mobileMenu.classList.remove('translate-x-full');
            document.body.style.overflow = 'hidden';
          });
          
          closeMobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.add('translate-x-full');
            document.body.style.overflow = '';
          });
        }
      });
    </script>
    @stack('scripts')
</body>
</html>
