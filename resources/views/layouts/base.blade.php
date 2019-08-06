<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title') - Toaster</title>

  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
</head>

<body>
  
<div class="d-flex">

  <div class="" id="wrapper">

    <!-- Sidebar -->
      <div class="bg-dark border-right text-light" id="sidebar-wrapper">
        <div class="sidebar-heading">Toaster</div>
        <div class="list-group list-group-flush">
          <a href="{{ route('users.show', Auth::id())}}" class="list-group-item list-group-item-action text-light bg-dark">{{ Auth::user()->name ?? 'Log in' }}</a>
          <a href="{{ route('my.profile.edit', Auth::id()) }}" class="list-group-item list-group-item-action text-light bg-dark">
            ->Settings
          </a>
          <a href="{{ route('logout') }}" class="list-group-item list-group-item-action text-light bg-dark mb-3">
            ->Logout
          </a>
          <a href="{{ route('my.feed') }}" class="list-group-item list-group-item-action text-light bg-dark">My Feed</a>
          <a href="{{ route('q.index') }}" class="list-group-item list-group-item-action text-light bg-dark">All questions</a>
          <a href="{{ route('tags.index') }}" class="list-group-item list-group-item-action text-light bg-dark">All tags</a>
          <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action text-light bg-dark">Users</a>
        </div>
      </div>

  </div>
  <div class="flex-grow-1">

    <!-- Page Content -->
      <nav class="navbar navbar-light text-light bg-dark border-bottom">

        <form action="/q/">
          
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
        <h3 class="mt-3">My feed</h3>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between">
            <div class="">
              <small class="text-muted d-block">PHP + 4 more</small>
              <h4><a href="">PHP PHP PHP</a></h4>
              <small class="text-muted d-block">1 Subscriber | 21 seconds ago | 15 views</small>          
            </div>
            <div class="my-1">
              <h4 class="text-muted text-center">5
                <small class="d-block">Answer</small>
              </h4>
            </div>
          </li>
          @yield('content')
        </ul>
      </div>
  </div>

  <div class="" id="wrapper">

    <!-- Sidebar -->
      <div class="bg-light border-left text-light" id="sidebar-wrapper">
        <div class="bg-dark sidebar-heading"><a class="btn btn-success" href="{{ route('q.create') }}">Ask a Question</a></div>
        <div class="sidebar-heading text-dark">Interesting</div>
        <ul class="list-group list-group-flush text-dark">
          <li class="list-group-item">
            <a class="d-block" href="">Post #1</a>
            <small class="d-inline">Answers : 1</small>  |
            <small class="d-inline">Subscribers: 2</small>
          </li>
          <!--foreach($interesting_questions as $question)
            <li class="list-group-item">
              <a class="d-block" href="">{}</a>
              <small class="d-inline">Answers : {}</small>  |
              <small class="d-inline">Subscribers: {}</small>    
            </li>     
          endforeach -->
        </ul>
      </div>
  </div>

</div>

</body>
</html>
