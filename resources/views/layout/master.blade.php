<!DOCTYPE html>
<html>
<head>

	{{-- Include the page meta --}}
	@include('layout.meta')

	{{-- Helper to generate SEO friendly page titles --}}
	<title>Legendary Productions - @yield('title')</title>

	{{-- Include CSS file and such --}}
	@include('layout.links')
	
</head>
<body>

	{{-- Include Nav --}}
	@include('layout.navbar')

	@yield('content')

	{{-- Include Scripts --}}
	@include('layout.scripts')
</body>
</html>