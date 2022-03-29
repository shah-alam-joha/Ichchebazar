@extends('backend.layouts.master')
@section('content')

<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				<p>Edit District</p>
			</div>

			<div class="card-body">
				 @include('backend.partials.message')
				<form action="{{ route('admin.district.update', $district->id) }}" method="post" enctype="multipart/form-data">
					@csrf

						<div class="form-group">
							<label for="name">District Name</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Enter district name" value="{{ $district->name}}">
						</div>

							<div class="form-group">
							<label for="division_id">Division</label>
							<select class="form-control" name="division_id">
								<option value="">Please Select a Division for this District</option>
								@foreach ($divisions as $division)
									<option value="{{ $division->id }}" {{ $district->division->id == $district->division_id ? 'selected' : ''}}>{{ $division->name }}</option>
								@endforeach
							</select>
						</div>

						<button type="submit" class="btn btn-primary">Update District</button>
				</form>


			</div>
		</div>
	</div>
</div>



@endsection