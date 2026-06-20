@extends('layouts.app')

@section('header')
<div class="animate-fade-in-down">
    <h2 class="text-3xl font-extrabold text-[#5B913B] flex items-center space-x-3">
        <i class="fas fa-chart-line text-[#FFE8B6] animate-pulse drop-shadow"></i>
        <span>Laporan Pendapatan</span>
    </h2>
</div>
@endsection

@section('content')
<div class="max-w-screen-xl mx-auto py-12 px-6 space-y-10">

    {{-- Filter & Ekspor --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white shadow-sm rounded-xl px-6 py-4 border border-[#D99D81]/20">
        <form method="GET" class="flex flex-wrap items-center gap-3">
            <label class="flex items-center gap-2 text-sm text-gray-700">
                <i class="fas fa-calendar-alt text-[#5B913B]"></i>
                <input
                    type="date"
                    name="from"
                    value="{{ request('from') }}"
                    class="rounded-lg border-gray-300 shadow-sm focus:ring-[#5B913B] focus:border-[#5B913B]"
                >
            </label>
            <span class="text-gray-500">s/d</span>
            <label class="flex items-center gap-2 text-sm text-gray-700">
                <i class="fas fa-calendar-alt text-[#5B913B]"></i>
                <input
                    type="date"
                    name="to"
                    value="{{ request('to') }}"
                    class="rounded-lg border-gray-300 shadow-sm focus:ring-[#5B913B] focus:border-[#5B913B]"
                >
            </label>

            <button type="submit"
                class="px-4 py-2 bg-[#5B913B] text-white rounded-md hover:bg-[#4A7B33] transition font-medium">
                <i class="fas fa-filter mr-1"></i> Tampilkan
            </button>
        </form>

        <div class="flex gap-2">
            <a href="{{ route('laporan.export.pdf', request()->query()) }}"
                class="group px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition"
                title="Ekspor sebagai PDF">
                <i class="fas fa-file-pdf mr-1 group-hover:scale-110 transition-transform"></i> PDF
            </a>
            <a href="{{ route('laporan.export.excel', request()->query()) }}"
                class="group px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition"
                title="Ekspor sebagai Excel">
                <i class="fas fa-file-excel mr-1 group-hover:scale-110 transition-transform"></i> Excel
            </a>
        </div>
    </div>

    {{-- Ringkasan Pendapatan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">
        <div class="bg-white shadow-lg rounded-2xl p-8 flex items-center space-x-7 hover:shadow-xl transition-transform transform hover:-translate-y-1 duration-300 border-l-4 border-[#77B254]">
            <div class="bg-[#FFE8B6] text-[#5B913B] p-5 rounded-full text-4xl shadow-inner">
                <i class="fas fa-wallet"></i>
            </div>
            <div>
                <p class="text-gray-500 font-semibold tracking-wide">Total Pendapatan</p>
                <p class="text-3xl font-bold text-[#5B913B]">Rp {{ number_format($data->sum('total'), 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    {{-- Chart --}}
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <h3 class="text-2xl font-bold mb-6 text-[#5B913B] flex items-center space-x-3">
            <i class="fas fa-chart-area text-[#D99D81]"></i>
            <span>Grafik Pendapatan</span>
        </h3>

        @if ($data->count())
            <canvas id="pendapatanChart" height="320px"></canvas>
        @else
            <div class="text-center text-gray-500 py-10">
                <i class="fas fa-info-circle text-3xl mb-2 text-[#D99D81]"></i>
                <p class="font-medium">Tidak ada data pendapatan pada rentang tanggal ini.</p>
            </div>
        @endif
    </div>
</div>

{{-- Chart.js --}}
@if ($data->count())
<script>
    const ctx = document.getElementById('pendapatanChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(91, 145, 59, 0.4)');
    gradient.addColorStop(1, 'rgba(91, 145, 59, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($data->pluck('tanggal')) !!},
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: {!! json_encode($data->pluck('total')) !!},
                backgroundColor: gradient,
                borderColor: '#5B913B',
                borderWidth: 4,
                fill: true,
                tension: 0.4,
                pointRadius: 6,
                pointHoverRadius: 9,
                pointBackgroundColor: '#77B254',
                pointBorderColor: 'white',
                pointHoverBorderColor: '#D99D81',
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
                    backgroundColor: '#5B913B',
                    callbacks: {
                        label: context => 'Rp ' + context.parsed.y.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#6B7280',
                        callback: value => 'Rp ' + value.toLocaleString('id-ID')
                    }
                },
                x: {
                    ticks: { color: '#6B7280' }
                }
            }
        }
    });
</script>
@endif
@endsection