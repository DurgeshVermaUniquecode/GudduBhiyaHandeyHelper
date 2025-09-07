<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'business_name', 
        'service_type', 'address', 'phone', 'about', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function employees()
{
    return $this->hasMany(Employee::class);
}
}

