@extends('backend.master')

@section('title','Stock Management | Home')

@push('css')
	<style>
		a{
			text-decoration: none!important;
		}
	</style>
@endpush

@section('content')
	 <div class="row">
        <div class="col-md-6 col-lg-3">
        	<a href="{{ route('category.index') }}">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-list fa-3x"></i>
            <div class="info">
              <h4>Category</h4>
              <p><b>{{ count($category) }}</b></p>
            </div>
          </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('subcategory.index') }}">
              <div class="widget-small info coloured-icon"><i class="icon fa fa-snowflake-o fa-3x"></i>
                <div class="info">
                  <h4>Subcategory</h4>
                  <p><b>{{ count($subcategory) }}</b></p>
                </div>
              </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
          <a href="{{ route('brand.index') }}">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
              <div class="info">
                <h4>Brand</h4>
                <p><b>{{ count($brand) }}</b></p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-3">
          <a href="{{ route('supplier.index') }}">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-truck fa-3x"></i>
              <div class="info">
                <h4>Supplier</h4>
                <p><b>{{ count($supplier) }}</b></p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-3">
          <a href="{{ route('customer.index') }}">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Customer</h4>
                <p><b>{{ count($customer) }}</b></p>
              </div>
            </div>
          </a>
        </div>
      </div>
@endsection