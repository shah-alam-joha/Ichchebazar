@extends('frontend.layouts.master')

@section('content')
<div class="container margin-top-20">
	<div class="row">
		<div class="col-md-4">

			@include('frontend.partials.products-sidebar')

		</div>
		<div class="col-md-8">
			<div class="widget">
				<h3>Products</h3>

				@include('frontend.pages.products.partials.all-products');

			</div>

		</div>
	</div>
</div>
@endsection