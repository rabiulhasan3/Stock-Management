@extends('backend.master')
@section('title')
  {{ config('app.name') }} | Sale Paid
@endsection
{{-- Breadcrumb Section Start --}}
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-shopping-cart"></i> Sale Paid</h1>
      <p>Showing All Sale Paid This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-shopping-cart"></i></li>
      <li class="breadcrumb-item">Sale Paid</li>
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
          	<br>
            <div class="tile-body" id="table_body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                  	<th>#</th>
                    <th width="10%">Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($all_sales_paid as $key=>$single_sale_paid)
	                  <tr>
	                  	<td>{{ ++$key }}</td>
                      <td class="text-center"><img class="img-responsive" src="{{ asset('uploads/products/'.$single_sale_paid->product->image) }}" style="height: 60px; width: 60px;" alt=""></td>
                      <td>{{ $single_sale_paid->product->name }}</td>
                      <td>{{ number_format($single_sale_paid->price,2) }}</td>
                      <td>{{ $single_sale_paid->qty }} </td>
                      <td>{{ number_format($single_sale_paid->total_price) }}</td>
                      <td>{{ number_format($single_sale_paid->paid_ammount) }}</td>
                      <td>{{ number_format($single_sale_paid->due_ammount) }}</td>
                      <td class="text-center">{{ $single_sale_paid->created_at->format('d-M-y')}}</td>
                      <td>
                       <a href="{{ route('sales.show',$single_sale_paid->id) }}" class="btn btn-sm btn-secondary">
                          <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
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