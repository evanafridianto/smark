<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_profile_id',
        'start_date',
        'end_date',
        'media',
        'cost',
        'description',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function businessProfile()
    {
        return $this->belongsTo(BusinessProfile::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['start_date'] ?? false, function ($query, $start_date) {
            return $query->whereDate('start_date', '>=', $start_date);
        });

        $query->when($filters['end_date'] ?? false, function ($query, $end_date) {
            return $query->whereDate('end_date', '<=', $end_date);
        });


        if (!empty($filters['start_date'])  && !empty($filters['end_date'])) {
            return $query->where('start_date', $filters['start_date'])->where('end_date', $filters['end_date']);
        }
    }
}