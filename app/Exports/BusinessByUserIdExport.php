<?php

namespace App\Exports;

use App\Models\BusinessProfile;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class BusinessByUserIdExport implements WithHeadings, WithStyles, FromQuery, WithMapping, WithTitle

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
        return BusinessProfile::query()->where('user_id', $this->id);
    }

    public function map($business): array
    {
        return [
            $business->id,
            $business->business_name,
            $business->category->name,
            $business->phone,
            $business->address,
            $business->founded_at,
            $business->social_media1,
            $business->social_media2,
            $business->social_media3,
        ];
    }

    public function headings(): array
    {
        return [
            'ID.',
            'Nama UMKM',
            'Kategori',
            'HP/WA',
            'Alamat',
            'Tanggal Berdiri',
            'Sosmed 1',
            'Sosmed 2',
            'Sosmed 3',
        ];
    }

    public function title(): string
    {
        return 'Profil UMKM';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}