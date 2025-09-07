<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','name','description','status'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function serviceTypes() {
        return $this->hasMany(ServiceType::class);
    }
}

