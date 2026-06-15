@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<h1 class="text-3xl font-bold mb-8">Pesanan Saya</h1>

@if($orders->count() > 0)
    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">No. Pesanan</th>
                    <th class="px-6 py-3 text-left">Total</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Pembayaran</th>
                    <th class="px-6 py-3 text-left">Tanggal</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($orders as $order)
                    <tr>
                        <td class="px-6 py-4 font-semibold">{{ $order->order_number }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded text-sm font-semibold
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
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded text-sm font-semibold
                                @if($order->payment_status === 'unpaid') bg-red-100 text-red-800
                                @elseif($order->payment_status === 'paid') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800
                                @endif
                            ">
                                @switch($order->payment_status)
                                    @case('unpaid')
                                        Belum Dibayar
                                    @break
                                    @case('paid')
                                        Sudah Dibayar
                                    @break
                                    @default
                                        Gagal
                                @endswitch
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                Lihat Detail →
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $orders->links() }}
    </div>
@else
    <div class="bg-white rounded shadow p-12 text-center">
        <p class="text-gray-600 text-lg mb-4">Anda belum memiliki pesanan</p>
        <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Mulai Berbelanja
        </a>
    </div>
@endif
@endsection
