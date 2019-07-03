@extends('backend.master')
@section('title')
  {{ config('app.name') }} | Sales
@endsection

{{-- Breadcrumb Section Start --}}
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-shopping-cart"></i> Sales</h1>
      <p>Sales Category This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-shopping-cart"></i></li>
      <li class="breadcrumb-item">Add Sales</li>
      <li class="breadcrumb-item active"><a href="{{ route('sales.index') }}">Sales</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('home') }}">Home</a></li>
    </ul>
  </div>
@endsection
{{-- Breadcrumb Section End --}}

@section('content')
<input type="hidden" name="" id="token" value="{{ @csrf_token() }}">
	<div class="row">
        <div class="col-md-12">

          <div class="tile">
          	<h3 class="tile-title">Product Sales</h3>
          	<hr>
            <div class="tile-body">
                <form id="purchaseForm" class="form-horizontal" action="{{ route('sales.store') }}" method="post">
                	@csrf
                <section class="purchase_product">
                  <div class="form-group row">
                    
                    <div class="col-md-12">
                       <div class="form-group">
                      <label class="control-label">Select Product</label>
                      <select name="product_id" class="form-control" id="product_id">
                        <option value="">Select Product</option>
                        @foreach($stock_all_product as $single_stock_product)
                          <option value="{{ $single_stock_product->product_id }}">{{ $single_stock_product->product->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Sales Price</label>
                      <input type="text" placeholder="sales price" id="sales_price" name="sales_price" onkeyup="salesPrice()" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Qty</label>
                      <input type="text" placeholder="Qty" id="qty" onkeyup="Qty()" name="qty" class="form-control">
                      <span id="qty_message"></span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Total Price</label>
                      <input type="text" readonly="true" placeholder="Total" id="total_price" name="total_price" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Paid Ammount</label>
                      <input type="text" placeholder="0000" onkeyup="paidAmmount()" name="paid_ammount" id="paid_ammount" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Due Ammount</label>
                      <input type="text" readonly="true" placeholder="0000" id="due_ammount" name="due_ammount" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary">
                    </div>
                  </div>
                  </div>
                </div>
                <div class="col-md-5 offset-md-1">

                  <div class="row">
                    <div class="col-md-12">
                        <label class="control-label">phone</label>
                            <input class="form-control" onkeyup="customerPhone()" id="customer_phone" value="{{ old('phone') }}" type="text" placeholder="01XXXXXXXXXX" name="phone">
                            @foreach($errors->get('phone') as $massage)
                               <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                            @endforeach
                    </div>
                    <div class="col-md-12">
                      <label class="control-label">NAME</label>
                          <input class="form-control" id="name" value="{{ old('name') }}" type="text" placeholder="Enter customer name" name="name">
                          @foreach($errors->get('name') as $massage)
                             <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                          @endforeach
                    </div>
                    <div class="col-md-12">
                        <label class="control-label ">Email</label>
                        <input class="form-control" id="email" value="{{ old('email') }}" type="email" placeholder="Enter customer email" name="email">
                        @foreach($errors->get('email') as $massage)
                           <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                        @endforeach
                    </div>

                    <input type="hidden" name="old_customer_id" id="old_customer_id">
                    
                    <div class="col-md-12">
                       <label class="control-label">Address</label>
                    <textarea class="form-control" id="address" rows="4" name="address" placeholder="Enter your address">{{ old('address') }}</textarea>
                    @foreach($errors->get('address') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                    </div>
                  </div>

                </div>
                </div>
                </section>
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

      function customerPhone(){
        var customer_phone = $('#customer_phone').val();
        var token = $('#token').val();
         if(customer_phone != ''){
          $.ajax({
            type: 'post',
            url : "{{ url('sales/customercheck') }}",
            data: {
                'customer_phone': customer_phone,
                '_token': token,
            },
            success: function(response) {
                if (response == '0') {
                      $('#name').val('');
                      $('#name').attr('readonly',false);
                      $('#name').attr('required',true);
                      $('#email').val('');
                      $('#email').attr('readonly',false);
                      $('#email').attr('required',true);
                      $('#address').val('');
                      $('#address').attr('readonly',false);
                      $('#address').attr('required',true);
                  } else {
                      var response = JSON.parse(response);
                      var customer_id = response.id;
                      $('#name').val(response.name);
                      $('#name').attr('readonly',true);
                      $('#email').val(response.email);
                      $('#email').attr('readonly',true);
                      $('#address').val(response.address);
                      $('#address').attr('readonly',true);
                      $('#old_customer_id').val(customer_id);
                  }
            }
          });
        }else{
          //$('#child_category').html('<option value="">Select Parent Category</option>');
        }
         
      }

       // purchase price
       function salesPrice(){
        var product_id = $('#product_id').val();
        if(product_id != ''){
          var sales_price = $('#sales_price').val();
          var qty = $('#qty').val();
          if(sales_price != '' && qty != ''){
             var total_price = parseFloat(sales_price) * parseFloat(qty);
            $('#total_price').val(total_price);
          }
        }
       }

       // function qty
       function Qty(){
        var product_id = $('#product_id').val();
        
        if(product_id != ''){
          var sales_price = $('#sales_price').val();
          var qty = $('#qty').val();
          if(sales_price != '' && qty!= ''){
            var total_price = parseFloat(sales_price) * parseFloat(qty);
            $('#total_price').val(total_price);
          }
        }
       }

       //check available qty
        function Qty(){
        var product_id = $('#product_id').val();
        var token = $('#token').val();
        var qty = $('#qty').val();
        
        if(product_id != ''){
          $.ajax({
            type: 'post',
            url : "{{ url('sales/productqunatitycheck') }}",
            data: {
                'product_id': product_id,
                'qty': qty,
                '_token': token,
            },
            success: function(response) {
                $('#qty_message').html(response);
            }
          });
        }
       }

       

       //paid ammount
       function paidAmmount(){
        var total_price = $('#total_price').val();
        if(total_price != ''){
          var paid_ammount = $('#paid_ammount').val();
          var due_ammount = total_price - parseFloat(paid_ammount);
          $('#due_ammount').val(due_ammount);
        }
       }



       // validation
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
   

   
       $('#purchaseForm').validate({
           rules : {
               
               product_id : {
                   required : true,
               },
               sales_price : {
                   required : true,
               },
               qty : {
                   required : true,
               },
               paid_ammount : {
                   required : true,
               }
           },
           messages : {
              
               product_id : {
                   required : 'please select product',
               },
               sales_price : {
                   required : 'please give product price',
               },
               qty : {
                   required : 'pleae give product quantity',
               },
               paid_ammount : {
                   required : 'please give paid ammount',
               }
               
           }
       });
   }) 

    </script>
   
@endpush