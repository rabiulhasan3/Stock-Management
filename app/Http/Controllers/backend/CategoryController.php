<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Auth;

class CategoryController extends Controller
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
        $all_category = Category::latest()->get();
        return view('backend.category.index',compact('all_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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
            'name.required' => 'please write your category name !'
        ]);

        $category_name = trim($request->input('name'));

        $category = new Category;
        $category->name = $category_name;
        $category->slug = str_slug($category_name);
        $category->save();

        $notification = array(
            'message'    => 'Category Added Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('category.index')->with($notification);
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
        $category_info = Category::where('id',$id)->first();
        return view('backend.category.edit',compact('category_info'));
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
            'name.required' => 'please write your category name !'
        ]);

        $category_name = trim($request->input('name'));

        $category = Category::find($id);
        $category->name = $category_name;
        $category->slug = str_slug($category_name);
        $category->save();

        $notification = array(
            'message'    => 'Category Update Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $category_check = Category::find($id);
         if($category_check){
            $category_check->delete();
             $notification = array(
                'message'    => 'Category Delete Successfully.',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
         }
        
    }

}
