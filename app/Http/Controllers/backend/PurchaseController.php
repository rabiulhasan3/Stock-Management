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
use Auth;

class PurchaseController extends Controller
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
        $all_purchase = Purchase::latest()->get();
        return view('backend.purchase.index',compact('all_purchase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_supplier = Supplier::all();
        $all_category = Category::all();
        $all_brand    = Brand::all();
        $all_product  = Product::all();
        return view('backend.purchase.create',compact('all_supplier','all_category','all_brand','all_product'));
    }

    // find out subcategory with parent category
    public function childcategory(Request $request){
        $category_id = $request->parent_category_id;
        if($category_id){
            $data = Subcategory::where('category_id',$category_id)->get();
            
            if(count($data) > 0){
                echo '<option value="">Select Sub-Category !</option>';
                foreach($data as $key=>$single_subcategory){
                    echo '<option value="'.$single_subcategory->id .'">'.$single_subcategory->name.'</option>';
                }
            }else{
                echo '<option value="">Subcate Not Found !</option>';
            }
        }
    }

    // findout proudct using category subcategory
    public function productSearch(Request $request){
        $parent_category = $request->parent_category;
        $child_category = $request->child_category;
        $brand_id = $request->brand_id;
        
        if($parent_category && $child_category && $brand_id){
            $data = Product::where('category_id',$parent_category)->where('subcategory_id',$child_category)->where('brand_id',$brand_id)->get();
           
            if(count($data) > 0){
                echo '<option value="">Select Product</option>';
                foreach($data as $key=>$single_product){
                    echo '<option value="'.$single_product->id .'">'.$single_product->name.'</option>';
                }
            }else{
                echo '<option value="">Product Not Found !</option>';
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
        $this->validate($request,[
            'supplier_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'product_id' => 'required',
            'purchase_price' => 'required',
            'qty' => 'required',
            'total_price' => 'required',
            'paid_ammount' => 'required',
        ],[
            'supplier_id.required' => 'please select supplier',
            'category_id.required' => 'please select product category',
            'subcategory_id.required' => 'please select product subcategory',
            'brand_id.required' => 'please select product band',
            'product_id.required' => 'please select purchase product',
            'purchase_price.required' => 'please write product purchase price',
            'qty.required' => 'pleae write product quantity',
            'paid_ammount.required' => 'please write purchase paid ammount',
        ]);

        $supplier_id = trim($request->input('supplier_id'));
        $product_id = trim($request->input('product_id'));
        $purchase_price = trim($request->input('purchase_price'));
        $qty = trim($request->input('qty'));
        $total_price = trim($request->input('total_price'));
        $paid_ammount = trim($request->input('paid_ammount'));
        $due_ammount = trim($request->input('due_ammount'));

        $check_product_in_stock = Stock::where('product_id',$product_id)->first();
        if(isset($check_product_in_stock)){
            $stock = Stock::where('product_id',$product_id)->first();
            $product_stock_data =  Stock::find($stock->id);
            $product_stock_data->qty = $product_stock_data->qty + $qty;
            $product_stock_data->available_qty = $product_stock_data->available_qty + $qty;
            $product_stock_data->save();
        }else{
            $stock = new Stock;
            $stock->product_id = $product_id;
            $stock->qty = $qty;
            $stock->available_qty = $qty;
            $stock->save();
        }

        $purchase = new Purchase;
        $purchase->supplier_id = $supplier_id;
        $purchase->product_id = $product_id;
        $purchase->price = $purchase_price;
        $purchase->qty = $qty;
        $purchase->available_qty = $qty;
        $purchase->total_price = $total_price;
        $purchase->paid_ammount = $paid_ammount;
        $purchase->due_ammount = $due_ammount;
        $purchase->is_stock = true;
        $purchase->save();



        $notification = array(
            'message'    => 'Purchase Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('purchase.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchae_info = Purchase::where('id',$id)->first();
        return view('backend.purchase.show',compact('purchae_info'));
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
