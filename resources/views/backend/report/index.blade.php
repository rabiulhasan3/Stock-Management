@extends('backend.master')
@section('title')
  {{ config('app.name') }} | Report
@endsection
{{-- Breadcrumb Section Start --}}
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-book"></i> Report</h1>
      <p>Showing All Report This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-shopping-cart"></i></li>
      <li class="breadcrumb-item">Report</li>
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
              <div class="col-md-6 col-lg-4">
                <a href="{{ route('purchase.index') }}">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                  <div class="info">
                    <h4>Total Purchase</h4>
                    <p><b>{{ number_format($total_parchase,2) }}</b></p>
                  </div>
                </div>
                </a>
              </div>
              <div class="col-md-6 col-lg-4">
                <a href="{{ route('report.total_purchase_due') }}">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                  <div class="info">
                    <h4>Total Purchase Due</h4>
                    <p><b>{{ number_format($total_parchase_due,2) }}</b></p>
                  </div>
                </div>
                </a>
              </div>
              <div class="col-md-6 col-lg-4">
                <a href="{{ route('report.total_purchase_paid') }}">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                  <div class="info">
                    <h4>Total Purchase Paid</h4>
                    <p><b>{{ number_format($total_parchase_paid,2) }}</b></p>
                  </div>
                </div>
                </a>
              </div>
            </div>

              <div class="row">
              <div class="col-md-6 col-lg-4">
                <a href="{{ route('sales.index') }}">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                  <div class="info">
                    <h4>Total Sales</h4>
                    <p><b>{{ number_format($total_sales,2) }}</b></p>
                  </div>
                </div>
                </a>
              </div>
              <div class="col-md-6 col-lg-4">
                <a href="{{ route('report.total_sales_due') }}">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                  <div class="info">
                    <h4>Total Sales Due</h4>
                    <p><b>{{ number_format($total_sale_due,2) }}</b></p>
                  </div>
                </div>
                </a>
              </div>
              <div class="col-md-6 col-lg-4">
                <a href="{{ route('report.total_sales_paid') }}">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                  <div class="info">
                    <h4>Total Purchase Paid</h4>
                    <p><b>{{ number_format($total_sale_paid,2) }}</b></p>
                  </div>
                </div>
                </a>
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