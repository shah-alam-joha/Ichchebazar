<form class="form-inline" action="{{ route('carts.store') }}" method="POST">
	@csrf
	<input type="hidden" name="product_id" value="{{ $product->id }}">
	<button type="button" style="margin-bottom: 10px" class="btn btn-warning" onclick="addToCart({{ $product->id }})">
		<i class="fa fa-plus"></i>Add to cart
	</button>
</form>
