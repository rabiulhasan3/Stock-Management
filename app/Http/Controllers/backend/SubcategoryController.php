<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subcategory;
use App\Category;
use Auth;

class SubcategoryController extends Controller
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
       $all_subcategory = Subcategory::latest()->get();
       return view('backend.subcategory.index',compact('all_subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$all_category = Category::get();
        return view('backend.subcategory.create',compact('all_category'));
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
            'category_id' => 'required',
        ],[
            'name.required' => 'please write sub-category name !',
            'category_id.required' => 'please select parent category',
        ]);

        $name = trim($request->input('name'));
        $category_id = trim($request->input('category_id'));

        $subcategory = new Subcategory;
        $subcategory->name = $name;
        $subcategory->slug = str_slug($name);
        $subcategory->category_id = $category_id;
        $subcategory->save();

        $notification = array(
            'message'    => 'Sub-Category Added Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('subcategory.index')->with($notification);
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
        $subcategory_info = Subcategory::where('id',$id)->first();
        $all_category = Category::all();
        return view('backend.subcategory.edit',compact('subcategory_info','all_category'));
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
            'category_id' => 'required',
        ],[
            'name.required' => 'please write sub-category name !',
            'category_id.required' => 'please select parent category',
        ]);

        $name = trim($request->input('name'));
        $category_id = trim($request->input('category_id'));

        $subcategory = Subcategory::find($id);;
        $subcategory->name = $name;
         $subcategory->slug = str_slug($name);
        $subcategory->category_id = $category_id;
        $subcategory->save();

        $notification = array(
            'message'    => 'Sub-Category Update Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('subcategory.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory_check = Subcategory::find($id);
        if($subcategory_check){
            $subcategory_check->delete();
             $notification = array(
                'message'    => 'Sub-Category Delete Successfully.',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }
}
