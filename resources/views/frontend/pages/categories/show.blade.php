@extends('frontend.layouts.master')

@section('content')
<div class="container margin-top-20">
	<div class="row">
		<div class="col-md-4">

			@include('frontend.partials.products-sidebar')

		</div>
		<div class="col-md-8">
			<div class="widget">
				<h3>All Products in <span class="badge badge-info">{{ $category->name }}  category</span></h3>
				@php
					$products = $category->products()->simplePaginate(9);
				@endphp

				@if ($products->count() > 0)
					@include('frontend.pages.products.partials.all-products');
					@else
					<div class="alert alert-warning">
						No product yet added in this category!
					</div>
				@endif

				

			</div>

		</div>
	</div>
</div>
@endsection