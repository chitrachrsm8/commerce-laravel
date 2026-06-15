@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="text-center py-12">
    <h1 class="text-5xl font-bold mb-4">Selamat Datang di Commerce</h1>
    <p class="text-xl text-gray-600 mb-8">Temukan produk terbaik dengan harga terjangkau</p>
    <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded text-lg hover:bg-blue-700">
        Mulai Belanja
    </a>
</div>

<div class="mt-12">
    <h2 class="text-3xl font-bold mb-8">Produk Unggulan</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach(\App\Models\Product::where('is_featured', true)->limit(4)->get() as $product)
            <div class="bg-white rounded shadow hover:shadow-lg transition">
                <img src="{{ $product->getMainImage() }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t">
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <div class="flex items-center mb-4">
                        <span class="text-yellow-400">★</span>
                        <span class="ml-2 text-sm">{{ $product->rating }}/5</span>
                    </div>
                    <a href="{{ route('products.show', $product->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm">Lihat Detail →</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
