<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  	<title>Toaster</title>

  	<!-- Scripts -->
  	<script src="{{ asset('js/app.js') }}" defer></script>
  	<script src="{{ asset('js/custom.js') }}" defer></script>

  	<!-- CSS -->
  	<link href="{{ asset('css/base.css') }}" rel="stylesheet">
  	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
  	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  	@yield('head')
</head>
<body>
	<section class="left-sidebar">
		<div class="sidebar-header">
			<h2>@yield('brand_title', 'Toaster')</h2>
		</div>
		<div class="left-menu">
			<div class="left-user-block">
				@auth
					<img class="small-icon m-2 d-inline" 
					src="{{ asset('storage/'.auth()->user()->profile_image) }}" alt="profile image">
					<a href="{{ route('users.info', auth()->user()->name) }}" 
					class="cards-list-item d-inline">{{ auth()->user()->name }}</a>
					<div class="cards-list ml-3">
						<a href="{{ route('users.edit', auth()->user()->name) }}"
						class="cards-list-item">Settings</a>
						<form method="POST" action="{{ route('logout') }}">
							@csrf

							<button class="cards-list-item" type="submit">Logout</button>
						</form>
					</div>
				@else
					<a class="cards-list-item" href="{{ route('login') }}">Login</a>
				@endauth
			</div>
			<hr>
			<div class="d-flex left-sidebar-links flex-column cards-list">
				@yield('left_sidebar')
			</div>
		</div>
	</section>
	<div class="main">
		<nav class="top-navbar">
			<form action="" class="form-inline">
				<div class="form-group">
					<input class="form-control search-field"
					type="text" name="search" id="search">
					<button type="submit" class="ml-2 btn btn-primary">Search</button>
				</div>
			</form>
		</nav>
		<main>
			<div class="m-3">
				<h3>@yield('content_header', 'There is no content!')</h3>
				@yield('content')
			</div>
		</main>
		<footer>
			<hr>
				<div class="m-2">
					<a href="{{ route('tags.index') }}">API</a>
				</div>
			<hr>
		</footer>	
	</div>
	
	<section class="right-sidebar">
		<div class="sidebar-header">
			@yield('sidebar_header')
		</div>
		@yield('right_sidebar')
	</section>


</body>
</html>