<?php

namespace App\Exports;

use App\Exports\UserByIdExport;
use App\Exports\RoasByUserIdExport;
use App\Exports\SalesByUserIdExport;
use App\Exports\BusinessByUserIdExport;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Exports\AdvertisementByUserIdExport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReportByUserExport implements WithMultipleSheets
{

    use Exportable;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function sheets(): array
    {
        $sheets = [
            new UserByIdExport($this->id),
            new BusinessByUserIdExport($this->id),
            new SalesByUserIdExport($this->id),
            new AdvertisementByUserIdExport($this->id),
            new RoasByUserIdExport($this->id),
        ];

        return $sheets;
    }
}