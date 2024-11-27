<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'postcode',
        'status',
        'date_of_birth',
        'notes'
    ];

    protected $casts = [
        'status' => StatusEnum::class,
        'date_of_birth' => 'date'
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('email', 'like', '%' . $value . '%')
            ->orWhere('phone', 'like', '%' . $value . '%')
            ->orWhere('postcode', 'like', '%' . $value . '%');
    }
}
