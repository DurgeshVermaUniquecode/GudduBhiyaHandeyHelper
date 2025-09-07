<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'title',
        'description',
        'price',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function serviceType() {
    return $this->belongsTo(ServiceType::class);
}


}

