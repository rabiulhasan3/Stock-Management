<?php

namespace App\Http\Controllers\backend\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchase;
use App\Product;
use App\Category;
use App\Subcategory;
use App\Brand;
use App\Sale;
use Auth;

class ReportController extends Controller
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
    	$total_parchase = Purchase::sum('total_price');
        $total_sales = Sale::sum('total_price');
    	$total_parchase_due = Purchase::sum('due_ammount');
        $total_sale_due = Sale::sum('due_ammount');
    	$total_parchase_paid = Purchase::sum('paid_ammount');
        $total_sale_paid = Sale::sum('paid_ammount');
    	return view('backend.report.index',compact('total_parchase','total_sales','total_parchase_due','total_sale_due','total_parchase_paid','total_sale_paid'));
    }

    public function total_purchase_due(){
    	$all_purchase_due = Purchase::where('due_ammount','>',0)->get();
    	return view('backend.report.total_purchase_due_history',compact('all_purchase_due'));
    }

    public function total_sales_due(){
        $all_sales_due = Sale::where('due_ammount','>',0)->get();
        return view('backend.report.total_sales_due_history',compact('all_sales_due'));
    }

     public function total_purchase_paid(){
    	$all_purchase_paid = Purchase::where('due_ammount',0)->get();
    	return view('backend.report.total_purchase_paid_history',compact('all_purchase_paid'));
    }

    public function total_sales_paid(){
        $all_sales_paid = Sale::where('due_ammount',0)->get();
        return view('backend.report.total_sale_paid_history',compact('all_sales_paid'));
    }
}
