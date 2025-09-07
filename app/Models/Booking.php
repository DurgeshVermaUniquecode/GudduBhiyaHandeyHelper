<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

  protected $fillable = [
    'customer_id',
    'vendor_id',
    'service_id',
    'employee_id',
    'booking_date',
    'status',
];

const STATUS_PENDING   = 'pending';
const STATUS_ACCEPTED  = 'accepted';
const STATUS_ASSIGNED  = 'assigned';
const STATUS_DECLINED  = 'declined';
const STATUS_COMPLETED = 'completed';


    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id'); // linking customers
    }
    public function employee()
{
    return $this->belongsTo(Employee::class);
}
}

