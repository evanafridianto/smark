<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserByIdExport implements WithHeadings, WithStyles, FromQuery, WithMapping, WithTitle

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
        return User::query()->where('id', $this->id);
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
        ];
    }

    public function title(): string
    {
        return 'Data User';
    }


    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}