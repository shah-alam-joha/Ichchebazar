@extends('frontend.layouts.master')

@section('content')
<div class="container">
	<div class="card mt-3">
		<div class="card-header">
			<h4>Confirm your orders</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-7 border-right">
					@foreach (App\Models\Cart::totalCarts() as $cart)

					<p>
						{{ $cart->product->title}} --
						<strong>{{ $cart->product->price}}</strong> Taka --
						{{ $cart->product_quantity}} items
					</p>
					@endforeach
					<a href="{{ route('carts.index') }}">
						<button class="btn btn-info"> Change Cart items</button>
					</a>
				</div>
				<div class="col-md-5">
					@php
					$total_price = 0;
					@endphp

					@foreach (App\Models\Cart::totalCarts() as $cart)

					@php
					$total_price += $cart->product->price * $cart->product_quantity;
					@endphp

					@endforeach
					<p>Total Amount: <strong> {{ $total_price }} </strong>Taka</p>
					<p>Total Amount with shipping charge: <strong> {{ $total_price + App\Models\Setting::first()->shipping_cost }} Taka </strong></p>
					
				</div>
			</div>

			

			
			

		</div>
	</div>

	<div class="card mt-5">
		<div class="card-header">
			<div class="row">

				<h4>Shipping Address</h4>
				
			</div>
		</div>
		<div class="card-body">

			<form method="POST" action="{{ route('checkouts.store') }}" enctype="multipart/form-data">
				@csrf

				<div class="row mb-3">
					<label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
					<div class="col-md-6">
						<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::check() ? Auth::user()->first_name. ' '.Auth::user()->last_name : '' }}" required autocomplete="name" autofocus>

						@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>


				<div class="row mb-3">
					<label for="phone_no" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>
					<div class="col-md-6">
						<input id="phone_no" type="number" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ Auth::check() ? Auth::user()->phone_no : '' }}" required autocomplete="phone_no" autofocus>

						@error('phone_no')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>


				<div class="row mb-3">
					<label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address(optional)') }}</label>
					<div class="col-md-6">
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" autocomplete="email">
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="message" class="col-md-4 col-form-label text-md-end">{{ __('Additional Message (optional)') }}</label>
					<div class="col-md-6">
						<textarea id="message"  class="form-control @error('message') is-invalid @enderror" name="message" autocomplete="message" autofocus rows="4"></textarea>

						@error('message')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="shipping_address" class="col-md-4 col-form-label text-md-end">{{ __('Shipping Address') }}</label>
					<div class="col-md-6">
						<textarea id="shipping_address"  class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" required autocomplete="shipping_address" autofocus rows="4">{{ Auth::check() ? Auth::user()->shipping_address : ''}}</textarea>

						@error('shipping_address')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="payment_method" class="col-md-4 col-form-label text-md-end">Select a payment method:</label>
					<div class="col-md-6">
						<select class="form-control" name="payment_method_id" id="payments" required>
							<option value="">Please select a payment method</option>

							@foreach ($payments as $payment)
							<option value="{{ $payment->short_name }}">{{ $payment->name}}</option>
							@endforeach

						</select>

						@foreach ($payments as $payment)
						
						@if ( $payment->short_name == "cash_on")
						
						<div id="payment_{{ $payment->short_name }}" class="hidden alert alert-success mt-3 text-center">
							<h4>For Cash on delivery there is nothing neccessary. Just Finish the order.
								<br>
								<small>You will get your product within two or three working days.</small>
							</h4>
						</div>
						

						@else
						<div id="payment_{{ $payment->short_name }}" class="alert alert-success mt-3 hidden text-center">
							<h3>{{ $payment->name}} Payment</h3>
							<p>
								<strong>{{ $payment->name}} No: {{ $payment->no }}</strong>
								<br>
								<strong>Account Type : {{ $payment->type}}</strong>
							</p>
							<div class="alert alert-success mt-2">
								<p>Please send the above money to this <strong>{{ $payment->no }}</strong> {{$payment->name}} number and write your transaction code below.</p>
							</div>
							
						</div>

						@endif

						@endforeach

						<input type="text" id="transaction_id"  name="transaction_id" id="transaction_id" class="form-control hidden" placeholder="Enter transection code">
						
					</div>
				</div>

				<div class="row mb-0">
					<div class="col-md-6 offset-md-4">
						<button type="submit" class="btn btn-primary">
							{{ __('Order Now') }}
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection


@section('scripts')
<script type="text/javascript">
	$("#payments").change(function(){
		$payment_method = $("#payments").val();

		if ($payment_method == "cash_on") {
			$("#payment_cash_on").removeClass('hidden');
			$("#payment_bkash").addClass('hidden');
			$("#payment_rocket").addClass('hidden');
			$("#transaction_id").addClass('hidden');

		}else if ($payment_method == "bkash") {
		
			$("#payment_bkash").removeClass('hidden');
			$("#payment_rocket").addClass('hidden');
			$("#payment_cash_on").addClass('hidden');
			$("#transaction_id").removeClass('hidden');
		}else if ($payment_method == "rocket") {
			
			$("#payment_rocket").removeClass('hidden');
			$("#payment_bkash").addClass('hidden');
			$("#payment_cash_on").addClass('hidden');
			$("#transaction_id").removeClass('hidden');

		}	
		
	});

</script>
@endsection