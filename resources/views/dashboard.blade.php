@extends('layouts.app')

@section('header')
    <div class="animate-fade-in-down">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-primary flex items-center gap-2 sm:gap-3">
            <i class="fas fa-cash-register text-accent animate-pulse"></i>
            <span>Dashboard Kasir</span>
        </h2>
    </div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:py-8 lg:py-10 px-3 sm:px-5 lg:px-6 space-y-8 sm:space-y-10 lg:space-y-12">
    @include('admin.order.orders-list', ['orders' => $orders])

    {{-- Statistik Ringkas --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-5 lg:gap-6">
        @php
            $stats = [
                ['label' => 'Total Produk', 'value' => $totalProduk, 'icon' => 'fas fa-box-open', 'bg' => 'bg-soft', 'text' => 'text-primary'],
                ['label' => 'Transaksi Hari Ini', 'value' => $totalTransaksiHariIni, 'icon' => 'fas fa-receipt', 'bg' => 'bg-soft', 'text' => 'text-highlight'],
                ['label' => 'Pendapatan Hari Ini', 'value' => 'Rp '.number_format($pendapatanHariIni,0,',','.'), 'icon' => 'fas fa-dollar-sign', 'bg' => 'bg-soft', 'text' => 'text-accent'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="bg-white shadow-sm rounded-2xl p-4 sm:p-5 lg:p-6 flex items-center gap-4 sm:gap-5 hover:shadow-md transition-all duration-300">
            <div class="{{ $stat['bg'] }} {{ $stat['text'] }} p-3 sm:p-4 rounded-2xl text-2xl sm:text-3xl shadow-inner">
                <i class="{{ $stat['icon'] }}"></i>
            </div>
            <div class="min-w-0">
                <p class="text-xs sm:text-sm text-gray-500 font-medium tracking-wide">{{ $stat['label'] }}</p>
                <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 truncate">{{ $stat['value'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Grafik Pendapatan --}}
    <div class="bg-white rounded-2xl shadow-sm p-4 sm:p-5 lg:p-6">
        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold mb-4 sm:mb-5 text-gray-800 flex items-center gap-2 sm:gap-3">
            <i class="fas fa-chart-area"></i>
            <span>Grafik Pendapatan Mingguan</span>
        </h3>
        <div class="h-64 sm:h-72 lg:h-80">
            <canvas id="pendapatanChart" class="w-full h-full"></canvas>
        </div>
    </div>

    {{-- Tombol Akses Cepat --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-5 lg:gap-6">
        <a href="{{ route('produk.index') }}"
            class="bg-gradient-to-br from-primary to-highlight hover:from-primary hover:to-primary text-white p-5 sm:p-6 rounded-2xl shadow-sm flex items-center justify-between transition-transform duration-300 hover:-translate-y-0.5">
            <div class="flex items-center gap-4 sm:gap-5 min-w-0">
                <i class="fas fa-box-open text-3xl sm:text-4xl drop-shadow-sm"></i>
                <div class="min-w-0">
                    <p class="text-base sm:text-lg font-semibold">Kelola Produk</p>
                    <p class="text-xs sm:text-sm text-white/80">Lihat dan ubah data produk</p>
                </div>
            </div>
            <i class="fas fa-chevron-right text-white/60"></i>
        </a>

        <a href="{{ url('/transaksi') }}"
            class="bg-gradient-to-br from-highlight to-primary hover:from-highlight hover:to-primary text-white p-5 sm:p-6 rounded-2xl shadow-sm flex items-center justify-between transition-transform duration-300 hover:-translate-y-0.5">
            <div class="flex items-center gap-4 sm:gap-5 min-w-0">
                <i class="fas fa-receipt text-3xl sm:text-4xl drop-shadow-sm"></i>
                <div class="min-w-0">
                    <p class="text-base sm:text-lg font-semibold">Lihat Transaksi</p>
                    <p class="text-xs sm:text-sm text-white/80">Pantau transaksi hari ini</p>
                </div>
            </div>
            <i class="fas fa-chevron-right text-white/60"></i>
        </a>

        <a href="{{ url('/laporan') }}"
            class="bg-gradient-to-br from-yellow-400 to-orange-500 hover:from-yellow-500 hover:to-orange-600 text-white p-5 sm:p-6 rounded-2xl shadow-sm flex items-center justify-between transition-transform duration-300 hover:-translate-y-0.5">
            <div class="flex items-center gap-4 sm:gap-5 min-w-0">
                <i class="fas fa-chart-line text-3xl sm:text-4xl drop-shadow-sm"></i>
                <div class="min-w-0">
                    <p class="text-base sm:text-lg font-semibold">Laporan Harian</p>
                    <p class="text-xs sm:text-sm text-white/80">Cek laporan pendapatan</p>
                </div>
            </div>
            <i class="fas fa-chevron-right text-white/60"></i>
        </a>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pendapatanChart').getContext('2d');

    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(91, 145, 59, 0.5)');
    gradient.addColorStop(1, 'rgba(91, 145, 59, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($pendapatanMingguanLabels),
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: @json($pendapatanMingguanData),
                backgroundColor: gradient,
                borderColor: '#5B913B',
                borderWidth: 4,
                fill: true,
                tension: 0.4,
                pointRadius: 6,
                pointHoverRadius: 9,
                pointBackgroundColor: '#5B913B',
                pointBorderColor: 'white',
                pointHoverBorderColor: 'white',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        font: { size: 14, weight: 'bold' },
                        color: '#374151'
                    }
                },
                tooltip: {
                    backgroundColor: '#2563EB',
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 13 },
                    callbacks: {
                        label: context => 'Rp ' + context.parsed.y.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#E5E7EB', borderDash: [5, 5] },
                    ticks: {
                        color: '#6B7280',
                        callback: value => 'Rp ' + value.toLocaleString('id-ID')
                    }
                },
                x: {
                    grid: { color: '#F3F4F6', borderDash: [3, 3] },
                    ticks: { color: '#6B7280' }
                }
            }
        }
    });
</script>
@endsection