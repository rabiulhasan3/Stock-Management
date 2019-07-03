<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Customer;

class CustomerController extends Controller
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
        $all_customer = Customer::where('status',1)->get();
        return view('backend.customer.index',compact('all_customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customer.create');
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
            'email' => 'required|unique:customers',
            'phone' => 'required|unique:customers',
            'address' => 'required',
        ],[
            'name.required' => 'please write customer name !',
            'email.required' => 'please enter customer email',
            'email.unique' => 'Email has already taken',
            'phone.required' => 'please enter customer phone number',
            'phone.unique' => 'This number has already taken',
            'address.required' => 'please enter customer address',
        ]);

        $name = trim($request->input('name'));
        $email = trim($request->input('email'));
        $phone = trim($request->input('phone'));
        $address = trim($request->input('address'));

        $customer = new Customer;
        $customer->name = $name;
        $customer->email = $email;
        $customer->phone = $phone;
        $customer->address = $address;
        $customer->save();

        $notification = array(
            'message'    => 'Customer Added Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('customer.index')->with($notification);
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
        $customer_info = Customer::where('id',$id)->first();
        return view('backend.customer.edit',compact('customer_info'));
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
        $customer = Customer::find($id);

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:customers,email,'.$customer->id,
            'phone' => 'required|unique:customers,phone,'.$customer->id,
            'address' => 'required',
        ],[
            'name.required' => 'please write customer name !',
            'email.required' => 'please enter customer email',
            'email.unique' => 'Email has already taken',
            'phone.required' => 'please enter customer phone number',
            'phone.unique' => 'This number has already taken',
            'address.required' => 'please enter customer address',
        ]);

        $name = trim($request->input('name'));
        $email = trim($request->input('email'));
        $phone = trim($request->input('phone'));
        $address = trim($request->input('address'));

        $customer->name = $name;
        $customer->email = $email;
        $customer->phone = $phone;
        $customer->address = $address;
        $customer->save();

        $notification = array(
            'message'    => 'Customer Update Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('customer.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer_check = Customer::find($id);
        if($customer_check){
            $customer_check->delete();
             $notification = array(
                'message'    => 'Customer Delete Successfully.',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }
}
