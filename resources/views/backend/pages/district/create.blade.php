@extends('backend.layouts.master')
@section('content')

<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				<p>Add District</p>
			</div>

			<div class="card-body">
				 @include('backend.partials.message')
				<form action="{{ route('admin.district.store') }}" method="post" enctype="multipart/form-data">
					@csrf

						<div class="form-group">
							<label for="name">District Name</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Enter district name">
						</div>

						<div class="form-group">
							<label for="division_id">Division</label>
							<select class="form-control" name="division_id">
								<option value="">Please Select a Division for this District</option>
								@foreach ($divisions as $division)
									<option value="{{ $division->id }}">{{ $division->name }}</option>
								@endforeach
							</select>
						</div>

					

						<button type="submit" class="btn btn-primary">Add District</button>
				</form>


			</div>
		</div>
	</div>
</div>



@endsection