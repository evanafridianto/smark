<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'business_name',
        'category_id',
        'founded_at',
        'phone',
        'address',
        'social media1',
        'social media2',
        'social media3',
    ];

    public function advertisement()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function sales()
    {
        return $this->hasMany(Sales::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}