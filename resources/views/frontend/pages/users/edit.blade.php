@extends('frontend.pages.users.master')

@section('sub-content')

<div class="card">
	<div class="card-body">
		<h4>Edit profile</h4>
		You can change, edit or delete your information
		<hr>
		

		<div class="card-body">
			<form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
				@csrf

				<div class="row mb-3">
					<label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
					<div class="col-md-6">
						<input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required autocomplete="first_name" autofocus>

						@error('first_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>


				<div class="row mb-3">
					<label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
					<div class="col-md-6">
						<input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autocomplete="last_name" autofocus>

						@error('last_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="username" class="col-md-4 col-form-label text-md-end">{{ __('User Name') }}</label>
					<div class="col-md-6">
						<input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>

						@error('username')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="phone_no" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>
					<div class="col-md-6">
						<input id="phone_no" type="number" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ $user->phone_no }}" required autocomplete="phone_no" autofocus>

						@error('phone_no')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>


				<div class="row mb-3">
					<label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>
					<div class="col-md-6">
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}"required autocomplete="email">
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="password" class="col-md-4 col-form-label text-md-end">{{ __('New Password(optional)') }}</label>
					<div class="col-md-6">
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" value="">

						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>


				<div class="row mb-3">
					<label for="division_id" class="col-md-4 col-form-label text-md-end">{{ __('Division Name') }}</label>
					<div class="col-md-6">
                           
                               <select class="form-control" name="division_id">
                               	<option value="">Please Select a Division</option>
                               	@foreach ($divisions as $division)
                               	<option value="{{ $division->id }}" {{ $user->division_id == $division->id ? 'selected' : ''}}>{{ $division->name }}</option>
                               	@endforeach
                               </select>

                               @error('division_id')
                               <span class="invalid-feedback" role="alert">
                               	<strong>{{ $message }}</strong>
                               </span>
                               @enderror
                           </div>
                       </div>


                       <div class="row mb-3">
                       	<label for="district_id" class="col-md-4 col-form-label text-md-end">{{ __('District Name') }}</label>
                       	<div class="col-md-6">
                       		<select class="form-control" name="district_id">
                       			<option value="">Please Select a District</option>
                       			@foreach ($districts as $district)
                       			<option value="{{ $district->id }}"{{ $user->district_id == $district->id ? 'selected' : ''}}>{{ $district->name }}</option>
                       			@endforeach
                       		</select>

                       		@error('district_id')
                       		<span class="invalid-feedback" role="alert">
                       			<strong>{{ $message }}</strong>
                       		</span>
                       		@enderror
                       	</div>
                       </div>

                       <div class="row mb-3">
                       	<label for="street_address" class="col-md-4 col-form-label text-md-end">{{ __('Street Address') }}</label>
                       	<div class="col-md-6">
                       		<input id="street_address" type="text" class="form-control @error('street_address') is-invalid @enderror" name="street_address" value="{{$user->street_address }}" required autocomplete="street_address" autofocus>

                       		@error('street_address')
                       		<span class="invalid-feedback" role="alert">
                       			<strong>{{ $message }}</strong>
                       		</span>
                       		@enderror
                       	</div>
                       </div>

                       <div class="row mb-3">
                       	<label for="shipping_address" class="col-md-4 col-form-label text-md-end">{{ __('Shipping Address(optional)') }}</label>
                       	<div class="col-md-6">
                       		<textarea id="shipping_address"  class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address"autocomplete="shipping_address" autofocus rows="4">{{ $user->shipping_address }}</textarea>

                       		@error('shipping_address')
                       		<span class="invalid-feedback" role="alert">
                       			<strong>{{ $message }}</strong>
                       		</span>
                       		@enderror
                       	</div>
                       </div>



                       <div class="row mb-0">
                       	<div class="col-md-6 offset-md-4">
                       		<button type="submit" class="btn btn-primary">
                       			{{ __('Update Profile') }}
                       		</button>
                       	</div>
                       </div>
                   </form>
               </div>
           </div>
       </div>


       @endsection