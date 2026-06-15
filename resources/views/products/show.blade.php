@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="grid grid-cols-2 gap-8 mb-12">
    <!-- Product Images -->
    <div>
        <div class="bg-white rounded shadow mb-4">
            <img id="mainImage" src="{{ $product->getMainImage() ?? 'https://via.placeholder.com/500' }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded">
        </div>
        @if($product->images->count() > 0)
            <div class="flex gap-2 overflow-x-auto">
                @foreach($product->images as $image)
                    <img src="{{ $image->image }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded cursor-pointer border-2 border-transparent hover:border-blue-600" onclick="document.getElementById('mainImage').src = this.src">
                @endforeach
            </div>
        @endif
    </div>

    <!-- Product Info -->
    <div>
        <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>
        
        <div class="flex items-center mb-6">
            <div class="flex items-center">
                <span class="text-2xl text-yellow-400">★</span>
                <span class="ml-2 text-lg">{{ $product->rating }}/5 ({{ $product->review_count }} review)</span>
            </div>
        </div>

        <div class="text-3xl font-bold text-blue-600 mb-4">
            Rp {{ number_format($product->price, 0, ',', '.') }}
        </div>

        <p class="text-gray-600 mb-6">{{ $product->description }}</p>

        <div class="mb-6">
            <span class="@if($product->isInStock()) text-green-600 font-semibold @else text-red-600 font-semibold @endif">
                @if($product->isInStock())
                    ✓ Tersedia ({{ $product->quantity }} stok)
                @else
                    ✗ Habis Terjual
                @endif
            </span>
        </div>

        @auth
            <form method="POST" action="{{ route('cart.add') }}" class="mb-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="flex items-center gap-4">
                    <input type="number" name="quantity" min="1" value="1" max="{{ $product->quantity }}" class="w-20 border rounded px-3 py-2">
                    <button type="submit" @disabled(!$product->isInStock()) class="flex-1 bg-blue-600 text-white py-3 rounded font-semibold hover:bg-blue-700 @disabled(!$product->isInStock()) opacity-50 cursor-not-allowed @enddisabled">
                        @if($product->isInStock())
                            Tambah ke Keranjang
                        @else
                            Produk Habis
                        @endif
                    </button>
                </div>
            </form>
        @else
            <div class="mb-6 p-4 bg-yellow-100 border border-yellow-400 rounded">
                <p class="text-yellow-800">Silakan <a href="{{ route('login') }}" class="font-semibold underline">login</a> untuk membeli produk ini</p>
            </div>
        @endauth

        <!-- Product Details -->
        <div class="border-t pt-6">
            <h3 class="text-lg font-semibold mb-4">Detail Produk</h3>
            <ul class="space-y-2 text-gray-600">
                <li><span class="font-semibold">SKU:</span> {{ $product->sku }}</li>
                <li><span class="font-semibold">Kategori:</span> {{ $product->category->name }}</li>
                <li><span class="font-semibold">Penjualan:</span> {{ $product->quantity_sold }} unit terjual</li>
            </ul>
        </div>
    </div>
</div>

<!-- Reviews Section -->
<div class="bg-white rounded shadow p-6 mb-12">
    <h2 class="text-2xl font-bold mb-6">Ulasan Pelanggan</h2>
    
    @if($product->reviews->count() > 0)
        <div class="space-y-6">
            @foreach($product->reviews as $review)
                <div class="border-b pb-6">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <p class="font-semibold">{{ $review->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $review->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="@if($i <= $review->rating) text-yellow-400 @else text-gray-300 @endif">★</span>
                            @endfor
                        </div>
                    </div>
                    <p class="text-gray-700">{{ $review->comment }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">Belum ada ulasan untuk produk ini</p>
    @endif
</div>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<div>
    <h2 class="text-2xl font-bold mb-6">Produk Terkait</h2>
    <div class="grid grid-cols-4 gap-6">
        @foreach($relatedProducts as $related)
            <div class="bg-white rounded shadow hover:shadow-lg transition">
                <img src="{{ $related->getMainImage() }}" alt="{{ $related->name }}" class="w-full h-48 object-cover rounded-t">
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2 truncate">{{ $related->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                    <a href="{{ route('products.show', $related->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm">Lihat Detail →</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif
@endsection
