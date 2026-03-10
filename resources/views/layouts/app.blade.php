<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Katalog Produk — Aplikasi katalog produk berbasis web">
    <title>@yield('title', 'Web Katalog')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col text-gray-900 antialiased">
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="text-lg font-bold tracking-tight text-gray-900">
                    Web Katalog
                </a>

                <div class="flex items-center gap-3">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition">
                                Dashboard
                            </a>
                        @endif
                        <span class="text-sm text-gray-400">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-red-500 hover:text-red-700 transition cursor-pointer">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="text-sm bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1">
        @if(session('success'))
            <div class="max-w-6xl mx-auto px-4 sm:px-6 mt-4">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-gray-100 bg-white mt-auto">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-6">
            <p class="text-center text-sm text-gray-400">&copy; {{ date('Y') }} Web Katalog. UKK 2026.</p>
        </div>
    </footer>
</body>
</html>
