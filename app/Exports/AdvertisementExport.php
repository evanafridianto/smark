<?php

namespace App\Exports;

use App\Models\Advertisement;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class AdvertisementExport implements WithHeadings, WithStyles, FromCollection, WithTitle

{
    public function collection()
    {
        return Advertisement::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'ID UMKM',
            'Start Date',
            'End Date',
            'Media',
            'Cost',
            'Keterangan',
            'Status',
        ];
    }

    public function title(): string
    {
        return 'Advertisement';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}