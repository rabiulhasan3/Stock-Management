<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Supplier;
use App\Product;
use App\Category;
use App\Subcategory;
use App\Brand;
use Carbon\Carbon;
use Auth;

class ProductController extends Controller
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
        $all_product = Product::latest()->get();
        return view('backend.product.index',compact('all_product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_category = Category::all();
        $all_brand = Brand::all();
        return view('backend.product.create',compact('all_category','all_brand'));
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
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ],[
            'name.required' => 'please write product name !',
            'description.required' => 'please write product description',
            'image.required' => 'please upload product image',
            'image.mimes' => 'invalid image type',
        ]);

        $name = trim($request->input('name'));
        $description = trim($request->input('description'));
        // image upload
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/products'))
            {
                mkdir('uploads/products',0777,true);
            }
            $image->move('uploads/products',$imagename);
        }else{
            $imagename = null;
        }

        $product = new Product;
        $product->category_id = trim($request->input('category_id'));
        $product->subcategory_id = trim($request->input('subcategory_id'));
        $product->brand_id = trim($request->input('brand_id'));
        $product->name = $name;
        $product->description = $description;
        $product->image = $imagename;
        $product->save();

        $notification = array(
            'message'    => 'Product Added Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('product.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_info = Product::where('id',$id)->first();
        return view('backend.product.show',compact('product_info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_info = Product::where('id',$id)->first();
        $all_category = Category::all();
        $all_brand = Brand::all();
        return view('backend.product.edit',compact('product_info','all_category','all_brand'));
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
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
        ],[
            'name.required' => 'please write product name !',
            'description.required' => 'please write product description',
            'image.mimes' => 'invalid image type',
        ]);

        $product = product::find($id);

        $image = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/products'))
            {
                mkdir('uploads/products',0777,true);
            }
            unlink('uploads/products/'.$product->image);
            $image->move('uploads/products',$imagename);
        }else{
            $imagename = $product->image;
        }

        $product->name = trim($request->input('name'));
        $product->category_id = trim($request->input('category_id'));
        $product->subcategory_id = trim($request->input('subcategory_id'));
        $product->brand_id = trim($request->input('brand_id'));
        $product->description = trim($request->input('description'));
        $product->image = $imagename;
        $product->status = 1;
        $product->save();

        $notification = array(
            'message'    => 'Product Update Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('product.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (file_exists('uploads/products/'.$product->image))
        {
            unlink('uploads/products/'.$product->image);
        }
        $product->delete();
         $notification = array(
            'message'    => 'Product Delete Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('product.index')->with($notification);
    }
}
