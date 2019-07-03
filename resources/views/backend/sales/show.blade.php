	@extends('backend.master')
  @section('title')
  {{ config('app.name') }} | Sales
@endsection
{{-- Breadcrumb Section Start --}}
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-product-hunt"></i> Sales</h1>
      <p>Sales Show This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-product-hunt"></i></li>
      <li class="breadcrumb-item">Show Sales</li>
      <li class="breadcrumb-item active"><a href="{{ route('purchase.index') }}">Sales</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('home') }}">Home</a></li>
    </ul>
  </div>
@endsection
{{-- Breadcrumb Section End --}}

@section('content')
		<div class="row">
        <div class="col-md-8">

          <div class="tile">
          	<h3>{{ $sales_info->product->name }}</h3>
            <h6>Category : {{ $sales_info->product->category->name }} / Subcategory : {{ $sales_info->product->subcategory->name }} / Brand : {{ $sales_info->product->brand->name }}</h6>
          	<hr>
            <h4>Customer information</h4>
          	<h6>Customer Name : {{ $sales_info->customer->name }}</h6>
            <h6>Customer Email : {{ $sales_info->customer->email }}</h6>
            <h6>Customer Mobile : {{ $sales_info->customer->phone }}</h6>
            <h6>Customer Address : {{ $sales_info->customer->address }}</h6>
            <hr>
            <h4>Purchase Information</h4>
            <h6>Product Price : {{ number_format($sales_info->price,2) }} tk.</h6>
            <h6>Product Qty : {{ $sales_info->qty }}</h6>
            <h6>Total Ammount : {{ number_format($sales_info->total_price) }} tk.</h6>
            <h6>Paid Ammount : {{ number_format($sales_info->paid_ammount) }} tk.</h6>
            <h6>Due Ammount : {{ number_format($sales_info->due_ammount) }} tk.</h6>

          </div>
        </div>
        <div class="col-md-4">
        	<div class="tile">
        		<h3>Product Image</h3>
        		<hr>
        		<img class="img-fluid img-responsive" src="{{ asset('uploads/products/'.$sales_info->product->image) }}" alt="">
        	</div>
        </div>
      </div>
@endsection

@push('scripts')

   
@endpush