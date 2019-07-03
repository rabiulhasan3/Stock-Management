@extends('backend.master')
{{-- Breadcrumb Section Start --}}
@section('title')
  {{ config('app.name') }} | Supplier
@endsection
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Supplier</h1>
      <p>Supplier Edit This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-truck"></i></li>
      <li class="breadcrumb-item">Edit Supplier</li>
      <li class="breadcrumb-item active"><a href="{{ route('supplier.index') }}">Supplier</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('home') }}">Home</a></li>
    </ul>
  </div>
@endsection
{{-- Breadcrumb Section End --}}

@section('content')
	<div class="row">
        <div class="col-md-8 offset-md-2">

          <div class="tile">
          	<h3 class="tile-title">Edit Supplier </h3>
          	<br>
            <div class="tile-body">
                <form class="form-horizontal" action="{{ route('supplier.update',$supplier_info->id) }}" method="post">
                	@csrf
                  @method('PUT')

                <div class="form-group row">
                  <label class="control-label col-md-3">NAME</label>
                  <div class="col-md-8">
                    <input class="form-control" value="{{ $supplier_info->name }}" type="text" placeholder="Enter supplier name" name="name">
                    @foreach($errors->get('name') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Email</label>
                  <div class="col-md-8">
                    <input class="form-control" value="{{ $supplier_info->email }}" type="email" placeholder="Enter supplier email" name="email">
                    @foreach($errors->get('email') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">phone</label>
                  <div class="col-md-8">
                    <input class="form-control" value="{{ $supplier_info->phone }}" type="text" placeholder="01XXXXXXXXXX" name="phone">
                    @foreach($errors->get('phone') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Description</label>
                  <div class="col-md-8">
                    <textarea class="form-control" rows="4" name="description" placeholder="Enter supplier description">{{ $supplier_info->description }}</textarea>
                    @foreach($errors->get('description') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Address</label>
                  <div class="col-md-8">
                    <textarea class="form-control" rows="4" name="address" placeholder="Enter your address">{{ $supplier_info->address }}</textarea>
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