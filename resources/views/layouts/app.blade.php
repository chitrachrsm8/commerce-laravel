<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Commerce')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">Commerce</a>
                
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600">Produk</a>
                    <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-blue-600">Keranjang</a>
                    @auth
                        <a href="{{ route('orders.index') }}" class="text-gray-700 hover:text-blue-600">Pesanan</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600 font-semibold">Admin</a>
                        @endif
                    @endauth
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-gray-700">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Alerts -->
    @if($errors->any())
        <div class="max-w-7xl mx-auto mt-4 px-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="max-w-7xl mx-auto mt-4 px-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto mt-4 px-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tentang Kami</h3>
                    <p class="text-gray-400">Platform e-commerce terpercaya untuk berbagai kebutuhan Anda.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kategori</h3>
                    <ul class="text-gray-400 space-y-2">
                        <li><a href="#" class="hover:text-white">Elektronik</a></li>
                        <li><a href="#" class="hover:text-white">Fashion</a></li>
                        <li><a href="#" class="hover:text-white">Rumah</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Bantuan</h3>
                    <ul class="text-gray-400 space-y-2">
                        <li><a href="#" class="hover:text-white">Hubungi Kami</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>
                    <ul class="text-gray-400 space-y-2">
                        <li><a href="#" class="hover:text-white">Facebook</a></li>
                        <li><a href="#" class="hover:text-white">Instagram</a></li>
                        <li><a href="#" class="hover:text-white">Twitter</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Commerce. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    @vite('resources/js/app.js')
</body>
</html>
