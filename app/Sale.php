<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Customer;

class Sale extends Model
{
    public function product(){
    	return $this->belongsTo(Product::class);
    }

    public function customer(){
    	return $this->belongsTo(Customer::class);
    }

}
