<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Subcategory;
use App\Brand;

class Product extends Model
{
    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function subcategory(){
    	return $this->belongsTo(Subcategory::class);
    }

    public function brand(){
    	return $this->belongsTo(Brand::class);
    }
}
