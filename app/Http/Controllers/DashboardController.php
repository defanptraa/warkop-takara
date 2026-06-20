<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaksi;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total produk
        $totalProduk = Product::count();

        // Total transaksi hari ini
        $totalTransaksiHariIni = Transaksi::whereDate('created_at', Carbon::today())->count();

        // Pendapatan hari ini
        $pendapatanHariIni = Transaksi::whereDate('created_at', Carbon::today())->sum('total_harga');

        // Pendapatan 7 hari terakhir
        $pendapatanMingguan = Transaksi::selectRaw('DATE(created_at) as tanggal, SUM(total_harga) as total')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Siapkan label tanggal dan data pendapatan default 0
        $dates = collect();
        $totals = collect();

        for ($i = 6; $i >= 0; $i--) {
            $dates->push(Carbon::now()->subDays($i)->format('d M'));
            $totals->push(0);
        }

        // Masukkan data pendapatan sesuai tanggal
        foreach ($pendapatanMingguan as $item) {
            $index = $dates->search(Carbon::parse($item->tanggal)->format('d M'));
            if ($index !== false) {
                $totals[$index] = (int) $item->total;
            }
        }

        // Ambil 3 pesanan terbaru dengan status baru atau proses, sekaligus relasi user
        $orders = Order::with('user')
            ->whereIn('status', ['baru', 'proses'])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('dashboard', [
            'totalProduk' => $totalProduk,
            'totalTransaksiHariIni' => $totalTransaksiHariIni,
            'pendapatanHariIni' => $pendapatanHariIni,
            'pendapatanMingguanLabels' => $dates,
            'pendapatanMingguanData' => $totals,
            'orders' => $orders,  // kirim ke view
        ]);
    }
}