@extends('backend.master')
@section('title')
  {{ config('app.name') }} | Purchase
@endsection

{{-- Breadcrumb Section Start --}}
@section('breadcrumb')
 <div class="app-title">
    <div>
      <h1><i class="fa fa-shopping-cart"></i> Purchase</h1>
      <p>Purchase Category This Page</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-shopping-cart"></i></li>
      <li class="breadcrumb-item">Add Purchase</li>
      <li class="breadcrumb-item active"><a href="{{ route('purchase.index') }}">Purchase</a></li>
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
          	<h3 class="tile-title">Create Purchase</h3>
          	<hr>
            <div class="tile-body">
                <form id="purchaseForm" class="form-horizontal" action="{{ route('purchase.store') }}" method="post">
                	@csrf
                <section class="purchase_product">
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label class="control-label">Select Supplier</label>
                      <select name="supplier_id" id="" class="form-control">
                      <option value="">Select Supplier</option>
                      @foreach($all_supplier as $key=>$single_supplier)
                        <option value="{{ $single_supplier->id }}">{{ $single_supplier->name }}</option>
                      @endforeach
                    </select>     
                    @foreach($errors->get('name') as $massage)
                       <p class="text-danger font-weight-bold"><small>{{ $massage }}</small></p>
                    @endforeach
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Select Category</label>
                      <select name="category_id" id="parent_category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach($all_category as $key=>$single_category)
                          <option value="{{ $single_category->id }}">{{ $single_category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Select Sub-Category</label>
                      <select name="subcategory_id" id="child_category" class="form-control">
                        <option value="">Select Sub-Category</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Select Brand</label>
                      <select name="brand_id" class="form-control" id="brand_id">
                        <option value="">Select Brand</option>
                        @foreach($all_brand as $key=>$single_brand)
                          <option value="{{ $single_brand->id }}">{{ $single_brand->name }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Select Product</label>
                      <select name="product_id" class="form-control" id="product_id">
                        <option value="">Select Product</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Purchase Price</label>
                      <input type="text" placeholder="purchase price" id="purchase_price" name="purchase_price" onkeyup="purchasePrice()" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Qty</label>
                      <input type="text" placeholder="Qty" id="qty" onkeyup="Qty()" name="qty" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Total Price</label>
                      <input type="text" readonly="true" placeholder="Total" id="total_price" name="total_price" class="form-control">
                    </div>
                  </div>
                  </div>
                </div>
                <div class="col-md-5 offset-md-1">
                  <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Paid Ammount</label>
                      <input type="text" placeholder="0000" onkeyup="paidAmmount()" name="paid_ammount" id="paid_ammount" class="form-control">
                    </div>
                  </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Due Ammount</label>
                      <input type="text" readonly="true" placeholder="0000" id="due_ammount" name="due_ammount" class="form-control">
                    </div>
                  </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary">
                    </div>
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

      // Brand Id
       $('#brand_id').on('change',function(){
        var brand_id = $('#brand_id').val();
        var parent_category = $('#parent_category').val();
        var child_category = $('#child_category').val();
        var token = $('#token').val();

        if(brand_id != '' && parent_category != '' && child_category != '' ){
          $.ajax({
            type: 'post',
            url : "{{ url('purchase/product') }}",
            data: {
                'parent_category': parent_category,
                'child_category': child_category,
                'brand_id': brand_id,
                '_token': token,
            },
            success: function(response) {
                $('#product_id').html(response);
            }
          });
        }else{
          $('#brand_id').html('<option value="">please select product brand</option>');
        }
      });

       // purchase price
       function purchasePrice(){
        var product_id = $('#product_id').val();
        if(product_id != ''){
          var purchasePrice = $('#purchase_price').val();
          var qty = $('#qty').val();
          if(purchasePrice != '' && qty != ''){
             var total_price = parseFloat(purchasePrice) * parseFloat(qty);
            $('#total_price').val(total_price);
          }
        }
       }

       // function qty
       function Qty(){
        var product_id = $('#product_id').val();
        
        if(product_id != ''){
          var purchasePrice = $('#purchase_price').val();
          var qty = $('#qty').val();
          if(purchasePrice != '' && qty!= ''){
            var total_price = parseFloat(purchasePrice) * parseFloat(qty);
            $('#total_price').val(total_price);
          }
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
               supplier_id : {
                   required : true,
               },
               category_id : {
                   required : true,
               },
               subcategory_id : {
                   required : true,
               },
               brand_id : {
                   required : true,
               },
               product_id : {
                   required : true,
               },
               purchase_price : {
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
               supplier_id : {
                   required : 'please select supplier',
               },
               category_id : {
                   required : 'please select category',
               },
               subcategory_id : {
                   required : 'please select subcategory',
               },
               brand_id : {
                   required : 'please select brand',
               },
               product_id : {
                   required : 'please select product',
               },
               purchase_price : {
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