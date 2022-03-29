@extends('frontend.layouts.master')

@section('content')
<div class="container margin-top-20">
	<div class="row">
		<div class="col-md-4">

			@include('frontend.partials.products-sidebar')

		</div>
		<div class="col-md-8">
			<div class="widget">
				<h3>Search Products for- <span class="badge badge-primary">{{ $search}}</span></h3>

				@if ($products->count() > 0)
				@include('frontend.pages.products.partials.all-products');
				@else
				<div class="alert alert-warning">
					Sorry there is no product by this search.
				</div>
				@endif

				

			</div>

		</div>
	</div>
</div>
@endsection