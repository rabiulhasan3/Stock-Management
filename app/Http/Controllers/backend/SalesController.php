<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchase;
use App\Supplier;
use App\Category;
use App\Subcategory;
use App\Brand;
use App\Product;
use App\Stock;
use App\Sale;
use App\Customer;
use DB;
use Auth;

class SalesController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_sales = Sale::latest()->get();
        return view('backend.sales.index',compact('all_sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_category = Category::all();
        $all_brand    = Brand::all();
        $all_product  = Product::all();
        $stock_all_product  = Stock::where('available_qty','>',0)->get();
        return view('backend.sales.create',compact('all_category','all_brand','all_product','stock_all_product'));
    }

    public function customercheck(Request $request){
        $customer_phone = $request->customer_phone;
        if(isset($customer_phone)){
            $customer_info = Customer::where('phone',$customer_phone)->first();
            
            echo json_encode( $customer_info );
        }
    }


    public function productqunatitycheck(Request $request){
        $product_id = $request->product_id;
        $qty  = $request->qty;
        if( isset($product_id) && isset($qty)){
            $product_info = Stock::where('product_id',$product_id)->first();
            if($product_info->available_qty >=  $qty){
                echo $product_info->available_qty .  ' product maximmum  sell';
            }else{
                echo 'not enought qty .you have maximum sell '.$product_info->available_qty;
            }
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->except('_token');

        $old_customer_id = $request->old_customer_id;

        $name          = trim($request->input('name'));
        $address          = trim($request->input('address'));
        $phone          = trim($request->input('phone'));
        $email           = trim($request->input('email'));

        $product_id            = trim($request->input('product_id'));
        $sales_price            = trim($request->input('sales_price'));
        $qty    = trim($request->input('qty'));
        $total_price = trim($request->input('total_price'));
        $paid_ammount      = trim($request->input('paid_ammount'));
        $due_ammount      = trim($request->input('due_ammount'));


        if(isset($old_customer_id) && isset($email)){

            $sale = new Sale;
            $sale->customer_id = $old_customer_id;
            $sale->product_id = $product_id;
            $sale->price = $sales_price;
            $sale->qty = $qty;
            $sale->total_price = $total_price;
            $sale->paid_ammount = $paid_ammount;
            $sale->due_ammount = $due_ammount;
            $sale->save();

            $stock_product  = Stock::where('available_qty','>',0)->where('product_id',$product_id)->first();
            $store_product_row = Stock::find($stock_product->id);
            $store_product_row->available_qty = $store_product_row->available_qty - $qty;
            $store_product_row->save();

            $notification = array(
                'message'    => 'Product Sale Successfully.',
                'alert-type' => 'success',
            );
            return redirect()->route('sales.index')->with($notification);
        }else{
            $customer_id = DB::table('customers')->insertGetId([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
            ] );

            $sale = new Sale;
            $sale->customer_id = $customer_id;
            $sale->product_id = $product_id;
            $sale->price = $sales_price;
            $sale->qty = $qty;
            $sale->total_price = $total_price;
            $sale->paid_ammount = $paid_ammount;
            $sale->due_ammount = $due_ammount;
            $sale->save();

             $stock_product  = Stock::where('available_qty','>',0)->where('product_id',$product_id)->first();
            $store_product_row = Stock::find($stock_product->id);
            $store_product_row->available_qty = $store_product_row->available_qty - $qty;
            $store_product_row->save();

            $notification = array(
                'message'    => 'Product Sale Successfully.',
                'alert-type' => 'success',
            );
            return redirect()->route('sales.index')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sales_info = Sale::where('id',$id)->first();
        return view('backend.sales.show',compact('sales_info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
