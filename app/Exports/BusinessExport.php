<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BusinessExport implements WithHeadings, WithStyles, WithTitle, FromQuery, WithMapping
{

    public function map($user): array
    {
        return [
            $user->businessProfile->id,
            $user->businessProfile->business_name,
            $user->businessProfile->category->name,
            $user->businessProfile->founded_at,
            $user->businessProfile->phone,
            $user->businessProfile->address,
            $user->businessProfile->social_media1,
            $user->businessProfile->social_media2,
            $user->businessProfile->social_media3,
        ];
    }

    public function query()
    {
        return User::with('businessProfile')->where('role', 'user');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama UMKM',
            'Kategori',
            'Tanggal Berdiri',
            'HP/WA',
            'Alamat',
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
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}