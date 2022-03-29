
<div class="row">

	@foreach ($products as $product)

	<div class="col-md-3" style="margin-top: 10px;">
		<div class="card product-card">

			@php $i=1; @endphp
			@foreach ($product->image as $image)

			@if ($i > 0)

			<a href="{{ route('products.show', $product->slug) }}">
				<img class="card-img-top feature-img product-imgage" style="height: 180px" src="{{ asset('images/products/'. $image->image ) }}" alt="{{$product->title}}">
			</a>
			@endif

			@php $i--; @endphp

			@endforeach

			<div class="card-body">
				<a href="{{ route('products.show', $product->slug) }}"><h4 class="card-title">{{ $product->title }} </h4></a>
				<p class="card-text">Taka-{{ $product->price }} </p>

				@include('frontend.pages.products.partials.cart-button')

			</div>
		</div>
	</div>


	@endforeach

</div>

<div class="mt-4 pagination">
	<p>{{ $products->links() }}</p>
</div>