@extends('frontend.layouts.master')

@section('content')

<div class="container mt-2">
	<div class="row">
		<div class="col-md-4">
			<div class="list-group">
				<a href="" class="list-group-item">
					<img src="{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id)}} " class="img rounded-circle" style="width:100px">
				</a>
				<a href="{{ route('user.dashboard') }}" class="list-group-item">Dashboard</a>
				<a href="{{ route('user.profile.edit') }}" class="list-group-item">Update Profile</a>
				

				<a href="" class="list-group-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Logout

                </a>  
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>  
                

            </div>
        </div>
        <div class="col-md-8">

        	@yield('sub-content')

        </div>
    </div>
</div>

@endsection