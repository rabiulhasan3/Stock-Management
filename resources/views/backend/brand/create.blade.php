@extends('backend.master')
@section('title')
  {{ config('app.name') }} | Brand
@endsection
{{-- Breadcrumb Section Start --}}
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-bandcamp"></i> Brand</h1>
      <p>Brand Category This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-bandcamp"></i></li>
      <li class="breadcrumb-item">Add Brand</li>
      <li class="breadcrumb-item active"><a href="{{ route('brand.index') }}">Brand</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('home') }}">Home</a></li>
    </ul>
  </div>
@endsection
{{-- Breadcrumb Section End --}}

@section('content')
	<div class="row">
        <div class="col-md-8 offset-md-2">

          <div class="tile">
          	<h3 class="tile-title">Create Brand</h3>
          	<br>
            <div class="tile-body">
                <form id="brandFrom" class="form-horizontal" action="{{ route('brand.store') }}" method="post">
                	@csrf
                <div class="form-group row">
                  <label class="control-label col-md-3">NAME</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" placeholder="Enter full name" name="name">
                    @foreach($errors->get('name') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>
                <div class="form-group row">
                	<div class="col-md-3"></div>
                  <div class="col-md-8">
                     <input type="submit" value="SAVE" class="btn btn-primary">
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
   

   
       $('#brandFrom').validate({
           rules : {
               name : {
                   required : true,
               },
           },
           messages : {
               name : {
                   required : 'please write subcategory name',
               },
               
           }
       });
   }) 
    </script>
   
@endpush