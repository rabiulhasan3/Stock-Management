	@extends('backend.master')
  @section('title')
  {{ config('app.name') }} | Purchase
@endsection
{{-- Breadcrumb Section Start --}}
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-product-hunt"></i> Purchase</h1>
      <p>Purchase Show This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-product-hunt"></i></li>
      <li class="breadcrumb-item">Show Purchase</li>
      <li class="breadcrumb-item active"><a href="{{ route('purchase.index') }}">Purchase</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('home') }}">Home</a></li>
    </ul>
  </div>
@endsection
{{-- Breadcrumb Section End --}}

@section('content')
		<div class="row">
        <div class="col-md-8">

          <div class="tile">
          	<h3>{{ $purchae_info->product->name }}</h3>
            <h6>Category : {{ $purchae_info->product->category->name }} / Subcategory : {{ $purchae_info->product->subcategory->name }} / Brand : {{ $purchae_info->product->brand->name }}</h6>
          	<hr>
            <h4>Supplier information</h4>
          	<h6>Supplier Name : {{ $purchae_info->supplier->name }}</h6>
            <h6>Supplier Email : {{ $purchae_info->supplier->email }}</h6>
            <h6>Supplier Mobile : {{ $purchae_info->supplier->phone }}</h6>
            <h6>Supplier Address : {{ $purchae_info->supplier->address }}</h6>
            <hr>
            <h4>Purchase Information</h4>
            <h6>Product Price : {{ number_format($purchae_info->price,2) }} tk.</h6>
            <h6>Product Qty : {{ $purchae_info->qty }}</h6>
            <h6>Total Ammount : {{ number_format($purchae_info->total_price) }} tk.</h6>
            <h6>Paid Ammount : {{ number_format($purchae_info->paid_ammount) }} tk.</h6>
            <h6>Due Ammount : {{ number_format($purchae_info->due_ammount) }} tk.</h6>

          </div>
        </div>
        <div class="col-md-4">
        	<div class="tile">
        		<h3>Product Image</h3>
        		<hr>
        		<img class="img-fluid img-responsive" src="{{ asset('uploads/products/'.$purchae_info->product->image) }}" alt="">
        	</div>
        </div>
      </div>
@endsection

@push('scripts')

   
@endpush