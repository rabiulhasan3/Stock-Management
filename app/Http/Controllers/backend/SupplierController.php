<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Supplier;
use Auth;

class SupplierController extends Controller
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
        $all_supplier = Supplier::latest()->get();
        return view('backend.supplier.index',compact('all_supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.supplier.create');
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
            'email' => 'required|unique:suppliers',
            'phone' => 'required',
            'description' => 'required',
            'address' => 'required',
        ],[
            'name.required' => 'please write sub-category name !',
            'email.required' => 'please enter supplier email',
            'email.unique' => 'Email has already taken',
            'phone.required' => 'please enter supplier phone number',
            'description.required' => 'please write supplier description',
            'address.required' => 'please enter supplier address',
        ]);

        $name = trim($request->input('name'));
        $email = trim($request->input('email'));
        $phone = trim($request->input('phone'));
        $description = trim($request->input('description'));
        $address = trim($request->input('address'));

        $supplier = new Supplier;
        $supplier->name = $name;
        $supplier->email = $email;
        $supplier->phone = $phone;
        $supplier->description = $description;
        $supplier->address = $address;
        $supplier->save();

        $notification = array(
            'message'    => 'Supplier Added Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('supplier.index')->with($notification);
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
        $supplier_info = Supplier::where('id',$id)->first();
        return view('backend.supplier.edit',compact('supplier_info'));
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
        $supplier = Supplier::find($id);

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:suppliers,email,'.$supplier->id,
            'phone' => 'required',
            'description' => 'required',
            'address' => 'required',
        ],[
            'name.required' => 'please write sub-category name !',
            'email.required' => 'please enter supplier email',
            'email.unique' => 'Email has already taken',
            'phone.required' => 'please enter supplier phone number',
            'description.required' => 'please write supplier description',
            'address.required' => 'please enter supplier address',
        ]);

        $name = trim($request->input('name'));
        $email = trim($request->input('email'));
        $phone = trim($request->input('phone'));
        $description = trim($request->input('description'));
        $address = trim($request->input('address'));

        
        $supplier->name = $name;
        $supplier->email = $email;
        $supplier->phone = $phone;
        $supplier->description = $description;
        $supplier->address = $address;
        $supplier->save();

        $notification = array(
            'message'    => 'Supplier Update Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('supplier.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier_check = Supplier::find($id);
        if($supplier_check){
            $supplier_check->delete();
             $notification = array(
                'message'    => 'Supplier Delete Successfully.',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }
}
