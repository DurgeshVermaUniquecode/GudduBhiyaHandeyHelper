<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = ['subcategory_id','name','description','status'];

    public function subcategory() {
        return $this->belongsTo(Subcategory::class);
    }

    public function services() {
        return $this->hasMany(Service::class);
    }
}

