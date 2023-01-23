<?php

namespace App\Exports;

use App\Models\Advertisement;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class AdvertisementByUserIdExport implements WithHeadings, WithStyles, FromQuery, WithMapping, WithTitle

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
        return Advertisement::query()->where('business_profile_id', $user->businessProfile->id);
    }

    public function map($sales): array
    {
        return [
            $sales->id,
            $sales->start_date,
            $sales->end_date,
            $sales->media,
            $sales->cost,
            $sales->description,
            $sales->status,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
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