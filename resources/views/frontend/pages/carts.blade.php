@extends('frontend.layouts.master')

@section('content')
<div class="container">
	<div class="card mt-2">
		<div class="card-header">
			<h3>Your carts information</h3>
		</div>
		<div class="card-body">
			@if (App\Models\Cart::totalItems() > 0)
			<table class="table table-striped table-bo">
				<tr>
					<th>No</th>
					<th>Product Title</th>
					<th>Product Image</th>
					<th>Product Quantity</th>
					<th>Delete</th>
					<th>Unit Price</th>
					<th>Sub Total</th>
				</tr>
				@php
				
				$total_price = 0;
				@endphp

				@foreach (App\Models\Cart::totalCarts() as $cart)
				
				<tr>
					<td>{{ $loop->index + 1}} </td>
					<td>
						<a href="{{ route('products.show', $cart->product->slug) }}">
							{{$cart->product->title}}
						</a>
					</td>

					<td>
						@if ($cart->product->image->count() > 0)
						
							<img src="{{ asset('images/products/'. $cart->product->image->first()->image ) }}" width="50px" height="40px">
						@endif
					</td>

					<td>
						<form class="form-inline" action="{{ route('carts.update', $cart->id) }}" method="post">
							@csrf
							<input type="number" name="product_quantity" value="{{$cart->product_quantity}}">
							<button type="submit" class="btn btn-info ml-1">Update</button>
						</form>
					</td>

					<td>
						<form class="form-inline" action="{{ route('carts.delete', $cart->id) }}" method="post">
							@csrf
							<input type="hidden" name="cart_id">
							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					</td>
					<td>{{ $cart->product->price}} Taka </td>

					@php
					$total_price += $cart->product_quantity * $cart->product->price;
					@endphp

					<td>{{ $cart->product_quantity * $cart->product->price }} Taka</td>

				</tr>

				@endforeach

				<tr>
					<td colspan="5"></td>
					<td>Total Amount:</td>
					<td> <strong>{{ $total_price }}</strong>  Taka </td>
				</tr>


			</table>
			<div class="float-right">

				<a href="{{ route('products') }}" class="btn btn-info btn-lg">Continue Shopping</a>
				<a href="{{ route('checkouts.index') }}" class="btn btn-warning btn-lg">Checkouts</a>
				

				
			</div>
				@else
				<div class="alert alert-warning">
					
						<p>There is no item in your cart.
							<br>
				<a href="{{ route('products') }}" class="btn btn-info btn-lg mt-2">Continue Shopping</a>

						</p>

					
				</div>
			@endif
		</div>
	</div>
</div>

@endsection