<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Brand;

class BrandController extends Controller
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
        $all_brand = Brand::latest()->get();
        return view('backend.brand.index',compact('all_brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
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
        ],[
            'name.required' => 'please write brand name !'
        ]);

        $brand_name = trim($request->input('name'));

        $brand = new Brand;
        $brand->name = $brand_name;
        $brand->slug = str_slug($brand_name);
        $brand->save();

        $notification = array(
            'message'    => 'Brand Added Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('brand.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand_info = Brand::where('id',$id)->first();
        return view('backend.brand.edit',compact('brand_info'));
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
        ],[
            'name.required' => 'please write brand name !'
        ]);

        $brand_name = trim($request->input('name'));

        $brand = Brand::find($id);
        $brand->name = $brand_name;
        $brand->slug = str_slug($brand_name);
        $brand->save();

        $notification = array(
            'message'    => 'Brand Name Update Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('brand.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $brand_check = Brand::find($id);
         if($brand_check){
            $brand_check->delete();
             $notification = array(
                'message'    => 'Brand Delete Successfully.',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
         }
        
    }
}
