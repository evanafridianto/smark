<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Roas extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'advertisement_id',
        'revenue_campaign',
        'roas_score',
        'conclusion',
    ];


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['start_date'] ?? false, function ($query, $start_date) {
            return $query->whereHas(
                'advertisement',
                fn ($q) =>
                $q->whereDate('start_date', '>=', $start_date)
            );
        });

        $query->when($filters['end_date'] ?? false, function ($query, $end_date) {
            return $query->whereHas(
                'advertisement',
                fn ($q) =>
                $q->whereDate('end_date', '>=', $end_date)
            );
        });


        if (!empty($filters['start_date'])  && !empty($filters['end_date'])) {
            return $query->whereHas(
                'advertisement',
                fn ($q) =>
                $q->where('start_date', $filters['start_date'])->where('end_date', $filters['end_date'])
            );
        }
    }

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }

    protected function roasScore(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format((float) $value, 2, '.', ''),
        );
    }
}