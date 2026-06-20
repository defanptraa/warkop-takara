<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'product'])
            ->latest()
            ->paginate(10); // Gunakan paginate jika banyak

        return view('admin.order.index', compact('orders'));
    }

    // 5 pesanan terbaru untuk dashboard
    public function latestOrders()
    {
        $orders = Order::with(['user', 'product'])
            ->whereIn('status', ['baru', 'proses'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.order.orders', compact('orders'));
    }

    // Terima pesanan (ubah status jadi proses)
    public function acceptOrder(Order $order)
    {
        if ($order->status === 'baru') {
            $order->update(['status' => 'proses']);
        }
        return back()->with('success', 'Pesanan diterima dan sedang diproses');
    }

    // Tandai selesai, pindah ke transaksi
    public function completeOrder(Order $order)
    {
        if ($order->status === 'proses') {
            // Buat transaksi baru
            Transaksi::create([
                'user_id' => Auth::id(), // Admin yang login
                'total_harga' => $order->total_harga,
                'created_at' => now(),
            ]);

            // Hapus pesanan yang selesai
            $order->delete();
        }
        return back()->with('success', 'Pesanan selesai dan sudah tercatat di transaksi');
    }

    // Hapus pesanan
    public function deleteOrder(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Pesanan berhasil dihapus');
    }

    // Tampilkan halaman pembayaran user
    public function pembayaranView()
    {
        return view('user.pembayaran');
    }

    // Simpan pesanan baru dari keranjang
    public function store(Request $request)
    {
        $request->validate([
            'cart' => 'required|array|min:1',
            'cart.*.id' => 'required|exists:products,id',
            'cart.*.qty' => 'required|integer|min:1',
        ]);

        foreach ($request->cart as $item) {
            $product = Product::find($item['id']);

            Order::create([
                'user_id' => Auth::id(), // Boleh null
                'product_id' => $product->id,
                'total_harga' => $product->harga * $item['qty'],
                'status' => 'baru',
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Pesanan berhasil disimpan!']);
    }
}
