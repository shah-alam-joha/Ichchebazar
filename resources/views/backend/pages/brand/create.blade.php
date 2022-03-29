@extends('backend.layouts.master')
@section('content')

<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				<p>Add brand</p>
			</div>

			<div class="card-body">
				 @include('backend.partials.message')
				 
				<form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
					@csrf

						<div class="form-group">
							<label for="name">Brand Name</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Enter brnad name">
						</div>

						<div class="form-group">
							<label for="description">Description</label>
							<textarea name="description" id="description" class="form-control"></textarea>
						</div>

						<div class="form-group">
							<label for="image">Image</label>
							<input type="file" name="image" id="image" class="form-control">
						</div>

						<button type="submit" class="btn btn-primary">Add brand</button>
				</form>


			</div>
		</div>
	</div>
</div>



@endsection