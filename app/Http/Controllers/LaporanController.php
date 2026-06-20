<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->input('from');
        $to   = $request->input('to');

        $query = Transaksi::selectRaw('DATE(created_at) as tanggal, SUM(total_harga) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc');

        if ($from && $to) {
            $query->whereBetween(DB::raw('DATE(created_at)'), [$from, $to]);
        } else {
            // Default: 7 hari terakhir
            $query->whereDate('created_at', '>=', now()->subDays(6));
        }

        $data = $query->get();

        return view('admin.laporan', compact('data'));
    }

    public function exportPdf(Request $request)
    {
        $from = $request->input('from');
        $to   = $request->input('to');

        $query = Transaksi::selectRaw('DATE(created_at) as tanggal, SUM(total_harga) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc');

        if ($from && $to) {
            $query->whereBetween(DB::raw('DATE(created_at)'), [$from, $to]);
        } else {
            $query->whereDate('created_at', '>=', now()->subDays(6));
        }

        $data = $query->get();

        $pdf = Pdf::loadView('exports.laporan-pdf', compact('data'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-pendapatan.pdf');
    }

    public function exportExcel(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        return Excel::download(new LaporanExport($from, $to), 'laporan-pendapatan.xlsx');
    }
}