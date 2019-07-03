@extends('backend.master')
@section('title')
  {{ config('app.name') }} | Category
@endsection
{{-- Breadcrumb Section Start --}}
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Category</h1>
      <p>Category Edit This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-th-list"></i></li>
      <li class="breadcrumb-item">Edit Category</li>
      <li class="breadcrumb-item active"><a href="{{ route('category.index') }}">Category</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('home') }}">Home</a></li>
    </ul>
  </div>
@endsection
{{-- Breadcrumb Section End --}}

@section('content')
	<div class="row">
        <div class="col-md-8 offset-md-2">

          <div class="tile">
          	<h3 class="tile-title">Edit Category </h3>
          	<br>
            <div class="tile-body">
                <form class="form-horizontal" action="{{ route('category.update',$category_info->id) }}" method="post">
                	@csrf
                  @method('PUT')

                <div class="form-group row">
                  <label class="control-label col-md-3">NAME</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" placeholder="Enter full name" name="name" value="{{ $category_info->name }}">
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
   
@endpush