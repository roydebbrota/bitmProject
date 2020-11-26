@extends('frontend.layouts.app')
@section('title','Cart-Details')
 @section('content')
 <section>
 	<div class="container">
 		<div class="row">
 			<div class="col">
 				<div class="card">
 					<div class="card-header">
 					<div class="h2">Cart Details</div>
 					</div>
					<div class="card-body">
						
						<table class="table table-sm">
						 	<tr>
						 		<th>Sl</th>
						 		<th>Image</th>
						 		<th>Name</th>
						 		<th>Price</th>
						 		<th class="pl-4">Qty</th>
						 		<th>Total</th>
						 		<th style="width: 35px"></th>
						 	</tr>
						 	@if(Session::has('cartProductList') && count(session('cartProductList'))>0)
						 	@php
						 	 $grandTotal =0; 
						 	@endphp

						 	@foreach (session('cartProductList') as $cartData)
						 	<tr>
						 		<td>{{$loop->iteration}}</td>
						 		<td>
						 			<img src="{{$cartData['image'] ? asset('/').'../storage/app/'.$cartData['image'] : asset('/').'images/user/user.jpg'}}" width="50">
						 		</td>
						 		<td>{{ $cartData['name']}}</td>
						 		<td>{{ $cartData['price']}}</td>
						 		<td class="align-middle">
						 			<a class="btn btn-sm btn-outline-success pQuantity" data-name="ptv" data-id="{{$cartData['id']}}" data-code="{{ $cartData['code']}}">+
						 			</a><button class="btn">
						 			{{ $cartData['quantity']}}</button>
						 			<a class="btn btn-sm btn-outline-warning pQuantity"data-name="ntv" data-id="{{$cartData['id']}}" data-code="{{ $cartData['code']}}">-
						 			</a>
						 		</td>
						 		<td>{{ $total = $cartData['quantity']*$cartData['price'] }}</td>
						 		<td>
						 			<button id="deleteCartItem" class="btn-sm btn btn-outline-danger text-decoration-none deleteCartItem" data-id="{{$cartData['id']}}" data-code="{{ $cartData['code']}}">X</button>
						 		 </td>
						 	</tr>
						 	@php
						 		$grandTotal+=$total;
						 	@endphp
						 	@endforeach
						 	<tr>
						 		<td colspan="4" class="text-right">Grand Total =
						 		</td>
						 		<td colspan="2" class="text-right">{{$grandTotal}}
						 		</td>
						 		<td>TK</td>
						 	</tr>
						 	@else
						 	<tr>
						 		<th colspan="7" class="badge-light text-center text-danger">Please buy some Product</th>
						 	</tr>
						 	@endif
						</table>
					</div>
 				</div>
 				<form method="post" action="{{ url('shop/product/payment_method') }}">
 					@csrf
 					<input type="hidden" name="surjaPay" value="{{$grandTotal}}">
 					<div class="col-12 text-center">
 						<input class="btn btn-info mt-2" type="submit" value="Payment">
 					</div>
 				</form>
 			</div>
 			
 		</div>
 		
 	</div>
 	{{-- Quantity Increase Decrease --}}
 	<form id="pQuantityForm" method="post" action="{{ url('shop/product/quantity') }}">
 		@csrf
 		<input type="hidden" name="act" id="act">
 		<input type="hidden" name="pId" id="pId">
 		<input type="hidden" name="code" id="code">
 		
 	</form>
 	{{-- Cart itam Delete --}}
 	<form id="itemDeleteForm" method="post" action="{{ url('cart/product/delete') }}">
 		@csrf
 		<input type="hidden" name="dId" id="dId">
 		<input type="hidden" name="dCode" id="dCode">
 		
 	</form>
 </section>
 @push('scripts')
 <script>
 	//Cart Quantity Increse Decrese
 
 $('.pQuantity').click(function(){
 var name = $(this).data('name');
 var id = $(this).data('id'); 
 var code = $(this).data('code');

 // form Values
$('#act').val(name);
$('#pId').val(id);
$('#code').val(code);
 // alert(name +id+code);
 // form Submision 
 $('#pQuantityForm').submit();
});

 //Cart Item Delete
 $('.deleteCartItem').click(function(){
 var dId = $(this).data('id');
 var dCode = $(this).data('code');

 // form Values
$('#dId').val(dId);
$('#dCode').val(dCode);
 // alert(dId+dCode);
 // form Submision 
 $('#itemDeleteForm').submit();
});
 </script>
 @endpush
 @endsection
 {{-- @push('scripts')
<script>
$('.pQuantity').click(function(){
	var name = $(this).data('name');
	var id = $(this).data('id');
	var code = $(this).data('code');
	
	// // Form Values //
	// $('#act').val(name);
	// $('#pId').val(id);
	// $('#code').val(code);
	// // Form Submission //
	// $('#pQuantityForm').submit();
	alert(name + id + code);
});
</script>
@endpush --}}