<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Toaster</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Scripts -->

  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/custom.js') }}" defer></script>
  <!-- Custom styles for this template -->
  <link href="{{ asset('css/base.css') }}" rel="stylesheet">
</head>

<body>
  
<div id="" class="d-flex">

  <div class="" id="sidebar-wrapper">

    <!-- Sidebar -->
      <div class="bg-dark border-right text-light hover-slide" id="">

        <div class="sidebar-heading">
          @yield('brand_title', 'Toster')
        </div>

        <div class="list-group list-group-flush">
          @auth
            <a href="" class="list-group-item list-group-item-action text-light bg-dark">{{ Auth::user()->name ?? 'Log in' }}</a>
            <a href="" class="list-group-item list-group-item-action text-light bg-dark">
              ->Settings
            </a>
            <a href="{{ route('logout') }}" class="list-group-item list-group-item-action text-light bg-dark mb-3">
              ->Logout
            </a>
          @else
            <a href="{{ route('login') }}" class="list-group-item
            list-group-item-action text-light bg-dark mb-3">
              ->Login
            </a>
          @endauth
          @section('left_sidebar')
            <a href="" class="list-group-item
            list-group-item-action text-light bg-dark">
              My Feed
            </a>
            <a href="" class="list-group-item
            list-group-item-action text-light bg-dark">
              All questions
            </a>
            <a href="" class="list-group-item
            list-group-item-action text-light bg-dark">
              All tags
            </a>
            <a href="" class="list-group-item
            list-group-item-action text-light bg-dark">
              Users
            </a>
          @show
        </div>
      </div>
  </div>
  <div class="flex-grow-1">

    <!-- Page Content -->
      <nav class="navbar navbar-light text-light bg-dark border-bottom">

        <form action="">
          
          <div class="form-row">     
              <div class="col-auto my-1">
                <input type="text" name="search" class="form-control" id="search" placeholder="Jane Doe">
              </div>
                
              <div class="col-auto my-1">
                <button type="submit" class="btn btn-outline-success">Submit</button>
              </div>
          </div>
        </form>        
      </nav>

      <div class="container">
        <h3 class="mt-3">@yield('content_header', 'There is no content!')</h3>  
        @section('base_content')
        
        @show
      </div>
  </div>

  <div class="" id="wrapper">

    <!-- Sidebar -->
      <div class="bg-light border-left text-light list-wrapper" id="sidebar-wrapper">

        <div class="bg-dark sidebar-heading">
          <a class="btn btn-success" href="{{ route('questions.create') }}">
            Ask a Question
          </a>
        </div>

        <div class="sidebar-heading text-dark">
          @yield('right_sidebar_header')
        </div>

        <ul class="list-group list-group-flush text-dark">
          @yield('right_sidebar')
        </ul>

      </div>
  </div>

</div>

</body>
</html>
