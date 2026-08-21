<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Fania Flower Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-green': '#516553',
                        'brand-pink': '#e595a0',
                        'bg-soft-pink': '#fdf6f6',
                        'bg-soft-green': '#eff2ef',
                    },
                    fontFamily: {
                        sans: ['"Poppins"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex h-screen overflow-hidden text-sm" x-data="{ sidebarOpen: false }">

    <!-- Mobile Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 bg-gray-900/50 z-40 md:hidden"></div>

    <!-- Sidebar (Desktop) / Drawer (Mobile) -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" class="w-64 bg-brand-green text-white flex flex-col h-full border-r border-gray-100/10 shadow-xl fixed md:relative z-50 shrink-0 transition-transform duration-300">
        <div class="h-16 flex items-center justify-center border-b border-white/10 px-4 gap-2">
            <i class="fa-solid fa-leaf text-brand-pink"></i>
            <span class="font-serif text-lg tracking-wide">Fania Flower Shop</span>
        </div>
        
        <nav class="flex-1 py-4 px-3 overflow-y-auto flex flex-col gap-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white transition' }}">
                <i class="fa-solid fa-gauge-high w-5 text-center"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('categories.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white transition' }}">
                <i class="fa-solid fa-layer-group w-5 text-center"></i>
                <span>Categories</span>
            </a>
            <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('products.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white transition' }}">
                <i class="fa-solid fa-box-open w-5 text-center"></i>
                <span>Products</span>
            </a>
            <a href="{{ route('gallery.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('gallery.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white transition' }}">
                <i class="fa-regular fa-image w-5 text-center"></i>
                <span>Gallery</span>
            </a>
            <a href="{{ route('messages.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('messages.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white transition' }}">
                <i class="fa-regular fa-envelope w-5 text-center"></i>
                <span>Messages</span>
            </a>
        </nav>
        
        <div class="px-3 py-4 border-t border-white/10">
            <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('settings.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white transition' }}">
                <i class="fa-solid fa-gear w-5 text-center"></i>
                <span>Settings</span>
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="mt-1">
                @csrf
                <button class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 hover:text-brand-pink transition">
                    <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-full overflow-hidden relative">
        <!-- Topbar -->
        <header class="h-16 bg-white border-b border-gray-200 px-4 flex items-center justify-between shrink-0 shadow-sm z-10">
            <div class="flex items-center gap-3">
                <button type="button" @click="sidebarOpen = true" class="md:hidden text-gray-500 hover:text-gray-700">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <h1 class="font-semibold text-lg text-gray-800">@yield('header_title')</h1>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" target="_blank" class="text-xs font-medium text-brand-green bg-bg-soft-green px-3 py-1.5 rounded-full hover:bg-green-100 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Web
                </a>
                <div class="flex items-center gap-2 border-l pl-4 border-gray-200">
                    <div class="w-8 h-8 rounded-full bg-brand-green/10 flex items-center justify-center text-brand-green font-bold">
                        A
                    </div>
                    <span class="text-sm font-medium text-gray-700 hidden sm:block">Admin</span>
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-6 lg:p-8">
            @if(session('success'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 rounded-md shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-circle-check text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4 rounded-md shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-triangle-exclamation text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
