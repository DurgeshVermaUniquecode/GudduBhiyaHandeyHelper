<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','name','description','status'];
    protected $table='subcategories';
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function serviceTypes() {
        return $this->hasMany(ServiceType::class);
    }
}

