@extends('backend.layouts.master')
@section('content')

<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				<p>Edit Division</p>
			</div>

			<div class="card-body">
				 @include('backend.partials.message')
				<form action="{{ route('admin.division.update', $division->id) }}" method="post" enctype="multipart/form-data">
					@csrf

						<div class="form-group">
							<label for="name">Division Name</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Enter division name" value="{{ $division->name}}">
						</div>

						<div class="form-group">
							<label for="priority_id">Priority_id</label>
							<input name="priority_id" id="priority_id" class="form-control" value="{{$division->priority_id}}" >{{ $division->name}}
						</div>

						<button type="submit" class="btn btn-primary">Update Division</button>
				</form>


			</div>
		</div>
	</div>
</div>



@endsection