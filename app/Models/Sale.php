<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'transaction_id',
        'business_profile_id',
        'date',
        'customer',
        'qty',
        'total',
        'status',
        'handling',
        'description',
    ];

    public function businessProfile()
    {
        return $this->belongsTo(BusinessProfile::class);
    }


    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['start_date'] ?? false, function ($query, $start_date) {
            return $query->whereDate('date', '>=', $start_date);
        });

        $query->when($filters['end_date'] ?? false, function ($query, $end_date) {
            return $query->whereDate('date', '<=', $end_date);
        });


        if (!empty($filters['start_date'])  && !empty($filters['end_date'])) {
            return $query->whereBetween('date', [$filters['start_date'], $filters['end_date']]);
        }
    }
}