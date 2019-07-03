@extends('backend.master')
@section('title')
  {{ config('app.name') }} | Brand
@endsection
{{-- Breadcrumb Section Start --}}
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-bandcamp"></i> Brand</h1>
      <p>Showing All Brand This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-bandcamp"></i></li>
      <li class="breadcrumb-item">Brand</li>
      <li class="breadcrumb-item active"><a href="{{ route('home') }}">Home</a></li>
    </ul>
  </div>
@endsection
{{-- Breadcrumb Section End --}}

@push('css')
	 <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@endpush

@section('content')
<input type="hidden" value="{{ csrf_token() }}" id="token">
	<div class="row">
        <div class="col-md-12">

          <div class="tile">
          	<h5>Brand List <a href="{{ route('brand.create') }}" class="float-right btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a></h5>
          	<br>
            <div class="tile-body" id="table_body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                  	<th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th class="text-center">Created Time</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($all_brand as $key=>$single_brand)
	                  <tr>
	                  	<td>{{ ++$key }}</td>
	                    <td>{{ $single_brand->name }}</td>
	                    <td>{{ $single_brand->slug }}</td>
	                    <td class="text-center">{{ $single_brand->created_at->format('d-M-y')}}</td>
	                    <td class="text-center">
	                    	<a href="{{ route('brand.edit',$single_brand->id) }}" class="btn btn-primary">
	                    		<i class="fa fa-pencil" aria-hidden="true"></i>
	                    	</a>
	                    	<span class="btn btn-danger" onclick="deleteBrand(id)" id="{{ $single_brand->id }}"><i class="fa fa-trash" aria-hidden="true"></i></span>
	                    	<form id="delete-brand{{$single_brand->id}}" action="{{ route('brand.destroy',$single_brand->id) }}" method="post" style="display: none">
                           @csrf
                            @method('DELETE')
                        </form>
	                    </td>
	                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('scripts')
	<!-- Data table plugin-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.all.min.js"></script>
     <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
                   <!-- Data table plugin-->
    <script type="text/javascript" src="{{ asset('assets/backend/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/backend/js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>

    <script>

    	//delete cember
		  function deleteBrand(id) {
		       swal({
		           title: 'Are you sure?',
		           text: "You Want To Delete This !",
		           type: 'warning',
		           showCancelButton: true,
		           confirmButtonColor: '#3085d6',
		           cancelButtonColor: '#d33',
		           confirmButtonText: 'Yes, delete it!'
		       }).then((result) => {
		           if (result.value) {
		               $('#delete-brand' + id).submit();
		           }
		       })
		   }


    	@if(Session::has('message'))
		   var type = "{{Session::get('alert-type','info')}}"
		   switch (type) {
		   case 'info':
		       toastr.info("{{ Session::get('message') }}");
		       break;
		   case 'success':
		       toastr.success("{{ Session::get('message') }}");
		       break;
		   case 'warning':
		       toastr.warning("{{ Session::get('message') }}");
		       break;
		   case 'error':
		       toastr.error("{{ Session::get('message') }}");
		       break;
		   }
		   @endif
    </script>
   
@endpush