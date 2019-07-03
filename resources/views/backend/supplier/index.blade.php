@extends('backend.master')
{{-- Breadcrumb Section Start --}}
@section('title')
  {{ config('app.name') }} | Supplier
@endsection
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Supplier</h1>
      <p>Showing All Supplier This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-truck"></i></li>
      <li class="breadcrumb-item">Supplier</li>
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
          	<h5>Supplier List <a href="{{ route('supplier.create') }}" class="float-right btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a></h5>
          	<br>
            <div class="tile-body" id="table_body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                	@foreach($all_supplier as $key=>$single_supplier)
	                  <tr>
                      <td>{{ ++$key }}</td>
	                   <td>{{ $single_supplier->name }}</td>
                     <td>{{ $single_supplier->email }}</td>
                     <td>{{ $single_supplier->phone }}</td>
                     <td>{{ $single_supplier->address }}</td>
                     <td class="text-center">
                        <a href="{{ route('supplier.edit',$single_supplier->id) }}" class="btn btn-primary">
                          <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        <span class="btn btn-danger" onclick="deleteSupplier(id)" id="{{ $single_supplier->id }}"><i class="fa fa-trash" aria-hidden="true"></i></span>
                        <form id="delete-supplier{{$single_supplier->id}}" action="{{ route('supplier.destroy',$single_supplier->id) }}" method="post" style="display: none">
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
		  function deleteSupplier(id) {
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
		               $('#delete-supplier' + id).submit();
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