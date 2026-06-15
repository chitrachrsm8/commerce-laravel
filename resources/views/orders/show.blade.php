@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800 mb-6">&larr; Kembali ke Pesanan</a>

    <div class="bg-white rounded shadow p-8 mb-6">
        <div class="flex justify-between items-start mb-6 border-b pb-6">
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $order->order_number }}</h1>
                <p class="text-gray-600">{{ $order->created_at->format('d F Y H:i') }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-600 mb-2">Status</p>
                <span class="px-4 py-2 rounded font-semibold
                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                    @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif
                ">
                    @switch($order->status)
                        @case('pending')
                            Menunggu
                        @break
                        @case('processing')
                            Diproses
                        @break
                        @case('shipped')
                            Dikirim
                        @break
                        @case('delivered')
                            Diterima
                        @break
                        @default
                            Dibatalkan
                    @endswitch
                </span>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4">Item Pesanan</h2>
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Produk</th>
                        <th class="px-4 py-2 text-left">Harga</th>
                        <th class="px-4 py-2 text-left">Jumlah</th>
                        <th class="px-4 py-2 text-left">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($items as $item)
                        <tr>
                            <td class="px-4 py-3">{{ $item->product_name }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $item->quantity }}</td>
                            <td class="px-4 py-3 font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Summary -->
        <div class="grid grid-cols-2 gap-8">
            <div>
                <h2 class="text-lg font-bold mb-4">Alamat Pengiriman</h2>
                <p class="text-gray-700">{{ $order->shipping_address }}</p>
                @if($order->notes)
                    <p class="text-gray-600 mt-4"><span class="font-semibold">Catatan:</span> {{ $order->notes }}</p>
                @endif
            </div>
            <div class="bg-gray-50 p-6 rounded">
                <h2 class="text-lg font-bold mb-4">Ringkasan</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Ongkir</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-green-600">
                        <span>Diskon</span>
                        <span>-Rp {{ number_format($order->discount, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t pt-3 flex justify-between text-lg font-bold text-blue-600">
                        <span>Total</span>
                        <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($order->payment_status === 'unpaid')
        <div class="bg-yellow-100 border border-yellow-400 rounded p-6 text-center">
            <p class="text-yellow-800 mb-4">Pembayaran belum dilakukan. Silakan lakukan pembayaran untuk memproses pesanan.</p>
            <a href="{{ route('orders.payment', $order) }}" class="bg-yellow-600 text-white px-6 py-2 rounded hover:bg-yellow-700">
                Lakukan Pembayaran
            </a>
        </div>
    @endif
end>
@endsection
