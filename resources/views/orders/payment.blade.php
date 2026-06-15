@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-8">Pembayaran Pesanan</h1>

    <div class="bg-white rounded shadow p-8 mb-6">
        <div class="mb-6 pb-6 border-b">
            <h2 class="text-lg font-bold mb-2">Nomor Pesanan</h2>
            <p class="text-2xl font-semibold text-blue-600">{{ $order->order_number }}</p>
        </div>

        <div class="mb-6 pb-6 border-b">
            <h2 class="text-lg font-bold mb-4">Ringkasan Pesanan</h2>
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

        <div class="mb-6">
            <h2 class="text-lg font-bold mb-4">Pilih Metode Pembayaran</h2>
            
            <!-- Midtrans Payment -->
            <div class="border-2 border-blue-500 rounded p-4 cursor-pointer hover:bg-blue-50 transition">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="payment_method" value="midtrans" checked class="mr-3 w-4 h-4">
                    <div>
                        <p class="font-semibold text-blue-600">Midtrans</p>
                        <p class="text-sm text-gray-600">Kartu Kredit, Transfer Bank, E-Wallet</p>
                    </div>
                </label>
            </div>

            <!-- Bank Transfer -->
            <div class="border-2 border-gray-300 rounded p-4 cursor-pointer hover:bg-gray-50 transition mt-3">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="payment_method" value="bank_transfer" class="mr-3 w-4 h-4">
                    <div>
                        <p class="font-semibold">Transfer Bank Manual</p>
                        <p class="text-sm text-gray-600">BCA, Mandiri, BNI, CIMB Niaga</p>
                    </div>
                </label>
            </div>
        </div>

        <button id="payButton" class="w-full bg-blue-600 text-white py-3 rounded font-semibold hover:bg-blue-700">
            Bayar Sekarang
        </button>
    </div>

    <div class="bg-yellow-50 border border-yellow-200 rounded p-6">
        <p class="text-yellow-800 text-sm">
            <span class="font-semibold">Catatan:</span> Silakan hubungi customer service jika terjadi masalah dalam proses pembayaran.
        </p>
    </div>
</div>

<!-- Midtrans Script -->
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    document.getElementById('payButton').addEventListener('click', function() {
        // Integrasi dengan Midtrans SNAP
        // Implementation akan disesuaikan dengan Midtrans API
        alert('Sistem pembayaran sedang dikonfigurasi');
    });
</script>
@endsection
