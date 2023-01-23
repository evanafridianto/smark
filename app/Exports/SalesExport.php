<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class SalesExport implements WithHeadings, WithStyles, FromCollection, WithTitle

{

    public function collection()
    {
        return Sale::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'ID Transaksi',
            'ID UMKM',
            'ID Advertisement',
            'Tanggal',
            'Pelanggan',
            'Jumlah',
            'Total',
            'Status',
            'Penanganan',
            'Keterangan',
        ];
    }

    public function title(): string
    {
        return 'Penjualan';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}