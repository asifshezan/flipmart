<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public function  cat_parent(){
        return $this->belongsTo(ProductCategory::class, 'pro_cat_parent', 'pro_cat_id');
    }
}
