<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Fania Flower Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-green': '#516553',
                        'brand-pink': '#e595a0',
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
</head>
<body class="bg-[#fcf8f8] text-gray-800 font-sans min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-3xl overflow-hidden shadow-[0_20px_50px_rgba(229,149,160,0.15)] flex flex-col align-center p-8 md:p-10">
        
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-brand-green/10 text-brand-green rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-leaf text-2xl"></i>
            </div>
            <h1 class="text-2xl font-serif text-brand-green font-semibold">Fania Flower Shop</h1>
            <p class="text-gray-500 text-sm mt-1">Admin Dashboard Login</p>
        </div>

        @if($errors->any())
            <div class="mb-6 bg-red-50 text-red-600 p-3 rounded-lg text-sm border border-red-100 flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 text-red-600 p-3 rounded-lg text-sm border border-red-100 flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="flex flex-col gap-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/50" placeholder="admin@example.com">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition block bg-gray-50/50" placeholder="••••••••">
            </div>

            <button type="submit" class="mt-2 w-full bg-brand-green text-white font-medium py-3.5 rounded-xl hover:bg-opacity-90 transition shadow-md flex items-center justify-center gap-2">
                Secure Login <i class="fa-solid fa-arrow-right text-xs"></i>
            </button>
        </form>
        
        <p class="text-center text-xs text-gray-400 mt-8">
            &copy; 2026 Fania Flower Shop. Protected Area.
        </p>
    </div>

</body>
</html>
