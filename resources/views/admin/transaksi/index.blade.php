@extends('layouts.app')

@section('header')
    <div class="animate-fade-in-down">
        <h2 class="text-3xl font-extrabold text-primary flex items-center space-x-3">
            <i class="fas fa-receipt text-accent animate-pulse"></i>
            <span>Daftar Transaksi</span>
        </h2>
    </div>
@endsection

@section('content')
<div class="max-w-screen-xl mx-auto py-12 px-6 space-y-10">

    {{-- Ringkasan Dinamis --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col sm:flex-row justify-between sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h3 class="text-xl font-semibold text-gray-800">Transaksi Hari Ini</h3>
            <p class="text-gray-500">Pantau transaksi yang terjadi secara realtime.</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right">
                <p class="text-sm text-gray-500">Total Transaksi</p>
                <p class="text-lg font-bold text-primary" id="totalTransaksi">0</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Total Pendapatan</p>
                <p class="text-lg font-bold text-accent" id="totalPendapatan">Rp 0</p>
            </div>
            <button id="refreshButton" class="bg-primary hover:bg-highlight text-white font-semibold px-4 py-2 rounded-lg transition-all">
                Refresh
            </button>
        </div>
    </div>

    {{-- Tabel Transaksi --}}
    <div class="bg-white shadow-md rounded-2xl overflow-x-auto">
        <table class="min-w-full table-auto text-left text-sm">
            <thead class="bg-soft text-primary uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">User</th>
                    <th class="px-6 py-4">Total Harga</th>
                    <th class="px-6 py-4">Waktu</th>
                </tr>
            </thead>
            <tbody id="transaksiBody" class="divide-y divide-gray-200">
                <tr>
                    <td colspan="4" class="text-center px-6 py-8 text-gray-400 animate-pulse">Memuat data transaksi...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- Script --}}
<script>
    const tbody = document.getElementById('transaksiBody');
    const totalTrx = document.getElementById('totalTransaksi');
    const totalPendapatan = document.getElementById('totalPendapatan');
    const refreshButton = document.getElementById('refreshButton');

    async function fetchTransaksi() {
        try {
            tbody.innerHTML = `<tr>
                <td colspan="4" class="text-center px-6 py-6 text-gray-400 animate-pulse">Memuat data...</td>
            </tr>`;

            const res = await fetch('{{ url("/api/transaksi/terbaru") }}');
            const data = await res.json();

            if (data.length === 0) {
                tbody.innerHTML = `<tr>
                    <td colspan="4" class="text-center px-6 py-6 text-gray-500">Belum ada transaksi hari ini</td>
                </tr>`;
                totalTrx.textContent = "0";
                totalPendapatan.textContent = "Rp 0";
                return;
            }

            let rows = '';
            let total = 0;

            data.forEach((trx, index) => {
                total += parseInt(trx.total_harga);

                rows += `
                    <tr class="hover:bg-gray-50 transition animate-fade-in-down">
                        <td class="px-6 py-4">${index + 1}</td>
                        <td class="px-6 py-4">${trx.user?.name ?? 'Tidak diketahui'}</td>
                        <td class="px-6 py-4 text-green-600 font-bold">Rp ${parseInt(trx.total_harga).toLocaleString('id-ID')}</td>
                        <td class="px-6 py-4">${new Date(trx.created_at).toLocaleTimeString('id-ID')} - ${new Date(trx.created_at).toLocaleDateString('id-ID')}</td>
                    </tr>`;
            });

            tbody.innerHTML = rows;
            totalTrx.textContent = data.length;
            totalPendapatan.textContent = 'Rp ' + total.toLocaleString('id-ID');

        } catch (err) {
            console.error("Gagal fetch transaksi", err);
            tbody.innerHTML = `<tr><td colspan="4" class="text-center px-6 py-6 text-red-500">Gagal memuat data transaksi</td></tr>`;
        }
    }

    refreshButton.addEventListener('click', fetchTransaksi);

    fetchTransaksi();
    setInterval(fetchTransaksi, 10000);
</script>
@endsection