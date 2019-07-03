<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Stock;
use App\Product;
use App\Purchase;
use Auth;
use DB;


class StockController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$stock_all_product = Stock::where('available_qty','>',0)->get();
    	return view('backend.stock.index',compact('stock_all_product'));
    }

    public function product_history($product_id){
        $all_purchase_history = Purchase::where('product_id',$product_id)->latest()->get();
        return view('backend.stock.product_purchase_history',compact('all_purchase_history'));
    }
}
