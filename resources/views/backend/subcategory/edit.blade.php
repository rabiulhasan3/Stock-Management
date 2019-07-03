@extends('backend.master')
@section('title')
  {{ config('app.name') }} | Sub-Category
@endsection
{{-- Breadcrumb Section Start --}}
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-snowflake-o"></i> Sub-Category</h1>
      <p>Sub-Category Edit This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-snowflake-o"></i></li>
      <li class="breadcrumb-item">Edit Sub-Category</li>
      <li class="breadcrumb-item active"><a href="{{ route('subcategory.index') }}">Sub-Category</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('home') }}">Home</a></li>
    </ul>
  </div>
@endsection
{{-- Breadcrumb Section End --}}

@section('content')
	<div class="row">
        <div class="col-md-8 offset-md-2">

          <div class="tile">
          	<h3 class="tile-title">Edit Sub-Category </h3>
          	<br>
            <div class="tile-body">
                <form class="form-horizontal" action="{{ route('subcategory.update',$subcategory_info->id) }}" method="post">
                	@csrf
                  @method('PUT')

                <div class="form-group row">
                  <label class="control-label col-md-3">NAME</label>
                  <div class="col-md-8">
                    <input class="form-control" value="{{ $subcategory_info->name }}" type="text" placeholder="Sub-Category Name" name="name">
                    @foreach($errors->get('name') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">CATEGORY</label>
                  <div class="col-md-8">
                    <select name="category_id" id="" class="form-control">
                      <option value="{{ $subcategory_info->category_id }}">{{ $subcategory_info->category->name }}</option>
                      @foreach($all_category as $key=>$single_category)
                        <option value="{{ $single_category->id }}">{{ $single_category->name }}</option>
                      @endforeach
                    </select>
                    @foreach($errors->get('category_id') as $massage)
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