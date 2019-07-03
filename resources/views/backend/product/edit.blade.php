@extends('backend.master')
@section('title')
  {{ config('app.name') }} | Product
@endsection
{{-- Breadcrumb Section Start --}}
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-product-hunt"></i> Product</h1>
      <p>Product Edit This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-product-hunt"></i></li>
      <li class="breadcrumb-item">Edit Product</li>
      <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">Product</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('home') }}">Home</a></li>
    </ul>
  </div>
@endsection
{{-- Breadcrumb Section End --}}

@section('content')
<input type="hidden" name="" id="token" value="{{ @csrf_token() }}">
	<div class="row">
        <div class="col-md-8 offset-md-2">

          <div class="tile">
          	<h3 class="tile-title">Edit Product </h3>
          	<br>
            <div class="tile-body">
                <form class="form-horizontal" action="{{ route('product.update',$product_info->id) }}" method="post" enctype="multipart/form-data">
                	@csrf
                  @method('PUT')

                  <div class="form-group row">
                  <label class="control-label col-md-3">SELECT CATEGORY</label>
                  <div class="col-md-8">
                    <select name="category_id" class="form-control" id="parent_category">
                      <option value="{{ $product_info->category_name }}">{{ $product_info->category->name }}</option>
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
                  <label class="control-label col-md-3">SELECT SUB-CATEGORY</label>
                  <div class="col-md-8">
                    <select name="subcategory_id" class="form-control" id="child_category">
                      <option value="{{ $product_info->subcategory_id }}">{{$product_info->subcategory->name }}</option>
                      
                    </select>
                    @foreach($errors->get('category_id') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label col-md-3">SELECT BRAND</label>
                  <div class="col-md-8">
                    <select name="brand_id" class="form-control" id="">
                      <option value="{{ $product_info->brand_id }}">{{ $product_info->brand->name }}</option>
                      @foreach($all_brand as $key=>$single_brand)
                        <option value="{{ $single_brand->id }}">{{ $single_brand->name }}</option>
                        @endforeach
                    </select>
                    @foreach($errors->get('category_id') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>

                 <div class="form-group row">
                  <label class="control-label col-md-3">NAME</label>
                  <div class="col-md-8">
                    <input class="form-control" value="{{ $product_info->name }}" type="text" placeholder="Enter Product name" name="name">
                    @foreach($errors->get('name') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="control-label col-md-3">IMAGE</label>
                  <div class="col-md-8">
                    <input class="form-control" type="file" name="image">
                    @foreach($errors->get('image') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="control-label col-md-3">DESCRIPTION</label>
                  <div class="col-md-8">
                    <textarea class="form-control" rows="4" name="description" placeholder="Enter product description" id="editor">{{ $product_info->description }}</textarea>
                    @foreach($errors->get('description') as $massage)
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
     <script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
    <script>
        $('#parent_category').on('change',function(){
        var parent_category_id = $('#parent_category').val();
        var token = $('#token').val();
        if(parent_category_id != ''){
          $.ajax({
            type: 'post',
            url : "{{ url('purchase/childcategory') }}",
            data: {
                'parent_category_id': parent_category_id,
                '_token': token,
            },
            success: function(response) {
                $('#child_category').html(response);
            }
          });
        }else{
          $('#child_category').html('<option value="">Select Parent Category</option>');
        }
      });
      ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
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