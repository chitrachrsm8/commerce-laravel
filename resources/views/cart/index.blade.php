@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<h1 class="text-3xl font-bold mb-8">Keranjang Belanja</h1>

@if($items->count() > 0)
    <div class="grid grid-cols-3 gap-6">
        <!-- Cart Items -->
        <div class="col-span-2 bg-white rounded shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left">Produk</th>
                        <th class="px-6 py-3 text-left">Harga</th>
                        <th class="px-6 py-3 text-left">Jumlah</th>
                        <th class="px-6 py-3 text-left">Subtotal</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($items as $item)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $item->product->getMainImage() }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded">
                                    <div>
                                        <p class="font-semibold">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-500">SKU: {{ $item->product->sku }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('cart.update', $item) }}" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" min="1" value="{{ $item->quantity }}" class="w-16 border rounded px-2 py-1" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td class="px-6 py-4 font-semibold">Rp {{ number_format($item->getSubtotal(), 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('cart.remove', $item) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Summary -->
        <div class="bg-white rounded shadow p-6 h-fit sticky top-20">
            <h2 class="text-lg font-bold mb-4">Ringkasan</h2>
            
            <div class="space-y-3 mb-6 border-b pb-6">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span class="font-semibold">Rp {{ number_format($items->sum(fn($item) => $item->getSubtotal()), 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Ongkir</span>
                    <span class="font-semibold">Rp 10.000</span>
                </div>
                <div class="flex justify-between">
                    <span>Diskon</span>
                    <span class="font-semibold text-green-600">Rp 0</span>
                </div>
            </div>

            <div class="flex justify-between text-lg font-bold mb-6 text-blue-600">
                <span>Total</span>
                <span>Rp {{ number_format($items->sum(fn($item) => $item->getSubtotal()) + 10000, 0, ',', '.') }}</span>
            </div>

            <a href="{{ route('orders.index') }}" class="block w-full bg-blue-600 text-white text-center py-3 rounded font-semibold hover:bg-blue-700 mb-2">
                Lanjut ke Checkout
            </a>
            
            <form method="POST" action="{{ route('cart.clear') }}" style="display: inline; width: 100%;">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-gray-300 text-gray-800 py-2 rounded hover:bg-gray-400">
                    Kosongkan Keranjang
                </button>
            </form>
        </div>
    </div>
@else
    <div class="bg-white rounded shadow p-12 text-center">
        <p class="text-gray-600 text-lg mb-4">Keranjang Anda kosong</p>
        <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Lanjut Berbelanja
        </a>
    </div>
@endif
@endsection
