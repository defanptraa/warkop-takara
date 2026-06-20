{{-- resources/views/admin/order/orders-list.blade.php --}}

<div class="max-w-screen-xl mx-auto py-10 px-6 bg-white rounded-3xl shadow-2xl transition">
    <h3 class="text-3xl font-bold text-primary flex items-center gap-3 mb-6">
        <i class="fas fa-receipt text-2xl text-primary"></i>
        Pesanan Terbaru
    </h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($orders as $order)
            <div class="group flex flex-col p-6 rounded-2xl border border-gray-200 bg-soft/50 hover:shadow-xl transition duration-200 ease-in-out hover:-translate-y-1">
                {{-- Info Produk --}}
                <div class="flex items-center gap-6 mb-4">
                    @if($order->product && $order->product->gambar)
                        <img src="{{ asset('storage/products/' . $order->product->gambar) }}"
                            alt="{{ $order->product->nama }}"
                            class="w-24 h-24 object-cover rounded-2xl border border-gray-300 shadow-md">
                    @else
                        <div class="w-24 h-24 flex items-center justify-center bg-gray-100 text-gray-500 rounded-2xl shadow-inner">
                            <i class="fas fa-image text-2xl"></i>
                        </div>
                    @endif

                    <div class="space-y-1">
                        <h4 class="text-xl font-bold text-primary">
                            <i class="fas fa-mug-hot mr-1 text-accent"></i>
                            {{ $order->product->nama ?? 'Menu tidak ditemukan' }}
                        </h4>
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-user mr-1 text-gray-500"></i><strong>User:</strong> {{ $order->user->name ?? 'Anonim' }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-money-bill-wave mr-1 text-green-600"></i><strong>Total:</strong> Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-info-circle mr-1 text-gray-500"></i><strong>Status:</strong>
                            @if($order->status === 'baru')
                                <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 px-2 py-1 text-xs font-medium rounded-full shadow-sm">
                                    <i class="fas fa-bell animate-pulse"></i> Baru
                                </span>
                            @elseif($order->status === 'proses')
                                <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-800 px-2 py-1 text-xs font-medium rounded-full shadow-sm">
                                    <i class="fas fa-spinner animate-spin"></i> Proses
                                </span>
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex flex-wrap gap-2 justify-start">
                    @if($order->status === 'baru')
                        <form action="{{ route('orders.accept', $order) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-primary hover:bg-highlight text-white px-4 py-2 text-sm rounded-xl flex items-center gap-2 shadow-md transition">
                                <i class="fas fa-check-circle"></i> Terima
                            </button>
                        </form>
                    @endif

                    @if($order->status === 'proses')
                        <form action="{{ route('orders.complete', $order) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 text-sm rounded-xl flex items-center gap-2 shadow-md transition">
                                <i class="fas fa-truck"></i> Selesai
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('orders.delete', $order) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus pesanan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-sm rounded-xl flex items-center gap-2 shadow-md transition">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-400 py-10">
                <i class="fas fa-inbox fa-2x mb-2"></i>
                <p class="text-lg font-medium">Belum ada pesanan baru</p>
            </div>
        @endforelse
    </div>

    {{-- Tombol navigasi lihat semua pesanan --}}
    <div class="mt-8 text-center">
        <a href="{{ route('orders.index') }}"
            class="inline-block bg-primary hover:bg-highlight text-white font-semibold px-6 py-3 rounded-xl shadow-lg transition">
            Lihat Semua Pesanan
        </a>
    </div>
</div>