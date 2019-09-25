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

		<div class="left-menu">
			<div class="sidebar-header">
				<h2>@yield('brand_title', 'Toaster')</h2>
			</div>
			<div class="left-user-block">
				@auth
					<a href="{{ route('users.info', auth()->user()->name) }}" 
					class="list-group-item">{{ auth()->user()->name }}</a>
					<div class="list-group ml-3">
						<a href="{{ route('users.edit', auth()->user()->name) }}" class="list-group-item">Settings</a>
						<form method="POST" action="{{ route('logout') }}">
							@csrf

							<button class="list-group-item" type="submit">Logout</button>
						</form>
					</div>
				@else
					<a class="list-group-item" href="{{ route('login') }}">Login</a>
				@endauth
			</div>
			<hr>
			<div class="list-group">
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
				@yield('base_content')
			</div>
		</main>
		<footer>
			<hr>
			footer
			<hr>
		</footer>	
	</div>
	
	<section class="right-sidebar">
		<div class="sidebar-header">
			<a href="
			@auth {{ route('questions.create') }}
			@else {{ route('login') }}
			@endauth" class="btn btn-success">Ask a question</a>
		</div>
		@yield('right_sidebar')
	</section>


</body>
</html>