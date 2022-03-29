<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		@yield('title', 'IchcheBazar')
	</title>

	@include('frontend.partials.style')

<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>

	<div class="wrapper">
		
		{{-- 	navbar here --}}
		@include('frontend.partials.navbar')

	@include('frontend.partials.message')
	
		{{-- here the main part --}}
		@yield('content')



		{{-- 	footer section  --}}
		@include('frontend.partials.footer')
		
	</div>

	@include('frontend.partials.script')
	
	@yield('scripts')

</body>


</html>