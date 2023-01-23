<?php

namespace App\Exports;

use App\Models\BusinessProfile;
use App\Models\Sale;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class SalesByUserIdExport implements WithHeadings, WithStyles, FromQuery, WithMapping, WithTitle

{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;


    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        $user = User::find($this->id);
        return Sale::query()->where('business_profile_id', $user->businessProfile->id);
    }

    public function map($sales): array
    {
        return [
            $sales->id,
            $sales->advertisement_id,
            $sales->transaction_id,
            $sales->date,
            $sales->customer,
            $sales->qty,
            $sales->total,
            $sales->status,
            $sales->handling,
            $sales->description,
        ];
    }

    public function headings(): array
    {
        return [
            'ID.',
            'ID Advertisement',
            'ID Transaksi',
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