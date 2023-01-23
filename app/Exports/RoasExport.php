<?php

namespace App\Exports;

use App\Models\Roas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class RoasExport implements WithHeadings, WithStyles, WithTitle, FromCollection

{
    public function collection()
    {
        return Roas::all();
    }

    public function headings(): array
    {
        return [
            'ID.',
            'ID Advertisement',
            'Revenue',
            'ROAS',
            'Simpulan',
        ];
    }

    public function title(): string
    {
        return 'ROAS';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}