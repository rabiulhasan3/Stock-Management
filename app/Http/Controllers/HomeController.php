<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use App\Brand;
use App\Supplier;
use App\Customer;
use Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category = Category::all();
        $subcategory = Subcategory::all();
        $brand = Brand::all();
        $supplier = Supplier::all();
        $customer  = Customer::all();
        return view('backend.dashboard',compact('category','subcategory','brand','supplier','customer'));
    }
}
