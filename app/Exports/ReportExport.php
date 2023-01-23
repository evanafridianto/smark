<?php

namespace App\Exports;

use App\Exports\RoasExport;
use App\Exports\UserExport;
use App\Exports\SalesExport;
use App\Exports\BusinessExport;
use App\Exports\AdvertisementExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReportExport implements WithMultipleSheets
{
    use Exportable;
    public function sheets(): array
    {
        $sheets = [
            new UserExport(),
            new BusinessExport(),
            new SalesExport(),
            new AdvertisementExport(),
            new RoasExport(),
        ];

        return $sheets;
    }
}