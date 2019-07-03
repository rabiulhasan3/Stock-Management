@extends('backend.master')
@section('title')
  {{ config('app.name') }} | Customer
@endsection
{{-- Breadcrumb Section Start --}}
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-users"></i> Customer</h1>
      <p>Customer Edit This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-users"></i></li>
      <li class="breadcrumb-item">Edit Customer</li>
      <li class="breadcrumb-item active"><a href="{{ route('customer.index') }}">Customer</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('home') }}">Home</a></li>
    </ul>
  </div>
@endsection
{{-- Breadcrumb Section End --}}

@section('content')
	<div class="row">
        <div class="col-md-8 offset-md-2">

          <div class="tile">
          	<h3 class="tile-title">Edit Customer </h3>
          	<hr>
            <div class="tile-body">
                <form class="form-horizontal" action="{{ route('customer.update',$customer_info->id) }}" method="post">
                	@csrf
                  @method('PUT')

                <div class="form-group row">
                  <label class="control-label col-md-3">NAME</label>
                  <div class="col-md-8">
                    <input class="form-control" value="{{ $customer_info->name }}" type="text" placeholder="Enter supplier name" name="name">
                    @foreach($errors->get('name') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Email</label>
                  <div class="col-md-8">
                    <input class="form-control" value="{{ $customer_info->email }}" type="email" placeholder="Enter supplier email" name="email">
                    @foreach($errors->get('email') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">phone</label>
                  <div class="col-md-8">
                    <input class="form-control" value="{{ $customer_info->phone }}" type="text" placeholder="01XXXXXXXXXX" name="phone">
                    @foreach($errors->get('phone') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Address</label>
                  <div class="col-md-8">
                    <textarea class="form-control" rows="4" name="address" placeholder="Enter your address">{{ $customer_info->address }}</textarea>
                    @foreach($errors->get('address') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>
                <div class="form-group row">
                	<div class="col-md-3"></div>
                  <div class="col-md-8">
                     <input type="submit" value="UPDATE" class="btn btn-primary">
                  </div>
                 
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('scripts')
	<!-- Data table plugin-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script>
             $(function(){
   
       $.validator.setDefaults({
               errorClass: 'invalid-feedback',
               highlight: function(element) {
               $(element)
                   .closest('.form-control')
                   .addClass('is-invalid');
               },
               unhighlight: function(element) {
               $(element)
                   .closest('.form-control')
                   .removeClass('is-invalid');
               },
       });
   

   
       $('#subcategoryForm').validate({
           rules : {
               name : {
                   required : true,
               },
               category_id : {
                   required : true,
               },
           },
           messages : {
               name : {
                   required : 'please write subcategory name',
               },
               category_id : {
                   required : 'please select parent category',
               },
               
           }
       });
   }) 
    </script>
   
@endpush