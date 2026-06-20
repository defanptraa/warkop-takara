<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $from;
    protected $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function collection()
    {
        return Transaksi::selectRaw('DATE(created_at) as tanggal, SUM(total_harga) as total')
            ->whereBetween(DB::raw('DATE(created_at)'), [$this->from, $this->to])
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return ['Tanggal', 'Total Pendapatan'];
    }
}
