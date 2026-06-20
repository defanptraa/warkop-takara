<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
// TransaksiController.php
    public function index()
    {
        $transaksis = \App\Models\Transaksi::with('user')
            ->whereDate('created_at', now())
            ->latest()
            ->get();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function getTerbaru()
    {
        $transaksis = \App\Models\Transaksi::with('user')
            ->whereDate('created_at', now())
            ->latest()
            ->get();

        return response()->json($transaksis);
    }
}
