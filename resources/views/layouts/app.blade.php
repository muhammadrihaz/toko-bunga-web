<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Fania Flower Shop')</title>

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
        <a href="{{ url('/') }}" class="flex flex-col">
          <img src="{{ asset('assets/erasebg-transformed.png') }}" alt="Fania Flower Shop" class="h-12 md:h-16 w-auto object-contain" />
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
        <div class="hidden md:flex items-center gap-2 border rounded-full px-3 py-1 text-sm border-gray-300 cursor-pointer hover:border-gray-400 transition select-none" id="langToggleBtn">
          <img src="https://flagcdn.com/w20/id.png" alt="Language flag" class="w-4 h-4 rounded-full transition-transform" id="langFlag" />
          <span id="langDisplayID" class="font-medium text-gray-800 transition-colors">ID</span>
          <span class="text-gray-300">|</span>
          <span id="langDisplayEN" class="text-gray-400 hover:text-brand-green transition-colors">EN</span>
          <i class="fa-solid fa-sync-alt text-xs text-gray-400 hover:rotate-180 transition-transform duration-300"></i>
        </div>
        <button class="md:hidden text-2xl text-gray-700 nav-arrow">
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>
    </header>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-brand-green text-white py-8">
      <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex flex-col items-center md:items-start">
          <img src="{{ asset('assets/erasebg-transformed.png') }}" alt="Fania Flower Shop" class="h-10 md:h-12 w-auto object-contain" />
        </div>
        <div class="flex flex-wrap justify-center gap-4 md:gap-8 text-sm text-gray-200">
          <a href="{{ url('/') }}" class="hover:text-white transition">Beranda</a>
          <a href="{{ url('/catalogue') }}" class="hover:text-white transition">Catalogue</a>
          <a href="{{ url('/gallery') }}" class="hover:text-white transition">Gallery</a>
          <a href="{{ url('/about') }}" class="hover:text-white transition">Tentang Kami</a>
          <a href="{{ url('/contact') }}" class="hover:text-white transition">Contact</a>
        </div>
        <div class="flex gap-4">
          <a href="{{ \App\Models\Setting::where('key', 'social_instagram')->value('value') ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full border border-gray-400 flex items-center justify-center hover:bg-white hover:text-brand-green transition"><i class="fa-brands fa-instagram"></i></a>
          <a href="{{ \App\Models\Setting::where('key', 'social_whatsapp')->value('value') ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full border border-gray-400 flex items-center justify-center hover:bg-white hover:text-brand-green transition"><i class="fa-brands fa-whatsapp"></i></a>
          <a href="{{ \App\Models\Setting::where('key', 'social_facebook')->value('value') ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full border border-gray-400 flex items-center justify-center hover:bg-white hover:text-brand-green transition"><i class="fa-brands fa-facebook-f"></i></a>
        </div>
      </div>
    </footer>

    <script src="{{ asset('js/lang.js') }}"></script>
    @stack('scripts')
</body>
</html>
