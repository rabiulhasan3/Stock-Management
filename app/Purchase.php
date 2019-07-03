<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Supplier;

class Purchase extends Model
{
    public function product(){
    	return $this->belongsTo(Product::class);
    }

    public function supplier(){
    	return $this->belongsTo(Supplier::class);
    }
}
