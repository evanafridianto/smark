<?php

namespace App\Exports;

use App\Models\Roas;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class RoasByUserIdExport implements WithHeadings, WithStyles, FromQuery, WithMapping, WithTitle

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
        return Roas::query()->whereHas('advertisement', fn ($q) => $q->where('business_profile_id', $user->businessProfile->id));
    }

    public function map($sales): array
    {
        return [
            $sales->id,
            $sales->advertisement_id,
            $sales->revenue_campaign,
            $sales->roas_score,
            $sales->conclusion,
        ];
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