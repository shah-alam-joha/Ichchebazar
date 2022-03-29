@extends('frontend.layouts.master')

@section('title')
{{ $product->title }} | IchcheBazar Ecommerce Site
@endsection

@section('content')
<div class="container margin-top-20">
	<div class="row">
		<div class="col-md-4">
			<div class="product-show-bg">
				
			

			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				{{-- <ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				</ol> --}}

				<div class="carousel-inner">

					@php $i=1; @endphp
					@foreach ($product->image as $image)
					<div class="carousel-item {{ $i == 1 ? 'active' : ''}}">
						<img class="d-block w-100 product-show-img" src="{{ asset('images/products/'.$image->image) }}" alt="First slide">
					</div>
					
					@php $i++; @endphp
					@endforeach

				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>

			<div class="mt-4">
				<p> Category : <span class="badge badge-info"> {{ $product->category->name }}</span></p>
				<p>Brand : <span class="badge badge-info"> {{ $product->brand->name }}</span></p> 
			</div>

		</div>

		<div class="col-md-8">
			<div class="widget">

				<h3>Product Name: {{$product->title}} </h3>

				<h4><p>Price:<b>{{$product->price}} Taka 
					<span class="badge badge-primary">
						{{ $product->quantity < 1 ? 'No item is available' : $product->quantity.' items is available' }}
					</span>
				</b></p>
			</h4>
			<hr>
			<p>{{$product->description}}</p>




		</div>

	</div>
</div>
</div>
@endsection