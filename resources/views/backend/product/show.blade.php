	@extends('backend.master')
  @section('title')
    {{ config('app.name') }} | Product
  @endsection
{{-- Breadcrumb Section Start --}}
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-product-hunt"></i> Product</h1>
      <p>Product Show This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-product-hunt"></i></li>
      <li class="breadcrumb-item">Show Product</li>
      <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">Product</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('home') }}">Home</a></li>
    </ul>
  </div>
@endsection
{{-- Breadcrumb Section End --}}

@section('content')
		<div class="row">
        <div class="col-md-8">

          <div class="tile">
          	<h3>{{ $product_info->name }}</h3>
            <h6>Category : {{ $product_info->category->name }} / Subcategory : {{ $product_info->subcategory->name }} / Brand : {{ $product_info->brand->name }}</h6>
          	<hr>
          	<p>
          		<?php echo htmlspecialchars_decode($product_info->description) ?>
          	</p>

          </div>
        </div>
        <div class="col-md-4">
        	<div class="tile">
        		<h3>Product Image</h3>
        		<hr>
        		<img class="img-fluid img-responsive" src="{{ asset('uploads/products/'.$product_info->image) }}" alt="">
        	</div>
        </div>
      </div>
@endsection

@push('scripts')

   
@endpush