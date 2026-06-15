@extends('layouts.app')

@section('title', 'Produk')

@section('content')
<div class="grid grid-cols-4 gap-6">
    <!-- Filter Sidebar -->
    <div class="col-span-1">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold mb-4">Filter</h3>
            
            <form method="GET" action="{{ route('products.index') }}" class="space-y-6">
                <!-- Kategori -->
                <div>
                    <label class="font-semibold text-sm mb-2 block">Kategori</label>
                    <select name="category" class="w-full border rounded px-3 py-2">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Harga -->
                <div>
                    <label class="font-semibold text-sm mb-2 block">Harga</label>
                    <div class="space-y-2">
                        <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="w-full border rounded px-3 py-2">
                        <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <!-- Sorting -->
                <div>
                    <label class="font-semibold text-sm mb-2 block">Urutkan</label>
                    <select name="sort" class="w-full border rounded px-3 py-2">
                        <option value="latest" @selected(request('sort') == 'latest')
>Terbaru</option>
                        <option value="price_low" @selected(request('sort') == 'price_low')
>Harga Terendah</option>
                        <option value="price_high" @selected(request('sort') == 'price_high')
>Harga Tertinggi</option>
                        <option value="popular" @selected(request('sort') == 'popular')
>Paling Populer</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Filter
                </button>
            </form>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="col-span-3">
        <div class="mb-6">
            <form method="GET" action="{{ route('products.index') }}" class="flex gap-2">
                <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}" class="flex-1 border rounded px-4 py-2">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Cari</button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded shadow hover:shadow-lg transition">
                    <img src="{{ $product->getMainImage() ?? 'https://via.placeholder.com/300x200' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2 truncate">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <span class="text-yellow-400">★</span>
                                <span class="ml-1 text-sm">{{ $product->rating }}/5</span>
                            </div>
                            <span class="text-xs @if($product->isInStock()) text-green-600 @else text-red-600 @endif">
                                @if($product->isInStock()) Tersedia @else Habis @endif
                            </span>
                        </div>
                        <a href="{{ route('products.show', $product->slug) }}" class="block w-full bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-600 text-lg">Tidak ada produk yang ditemukan</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
