@extends('backend.layouts.master')
@section('content')

<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				<p>Edit brand</p>
			</div>

			<div class="card-body">
				 @include('backend.partials.message')
				<form action="{{ route('admin.brand.update', $brand->id) }}" method="post" enctype="multipart/form-data">
					@csrf

						<div class="form-group">
							<label for="name">Brand Name</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Enter brnad name" value="{{ $brand->name}}">
						</div>

						<div class="form-group">
							<label for="description">Description</label>
							<textarea name="description" id="description" class="form-control">{{ $brand->description}}</textarea>
						</div>

						

						<div class="form-group">
							<label for="image">Image(optional)</label>
							<input type="file" name="image" id="image" class="form-control">
						</div>

						<button type="submit" class="btn btn-primary">Update brand</button>
				</form>


			</div>
		</div>
	</div>
</div>



@endsection