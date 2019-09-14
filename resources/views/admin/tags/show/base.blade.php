@extends('admin.base')

@section('content_header')
<div class="d-inline">{{ $tag->title }}</div>
@endsection

@section('content')

<h5 class="text-muted">{{ $tag->slug }}</h6>

<div class="mb-2">
	<h5 class="d-inline">Subscribers: {{ $tag->subscribers_count }}</h5>
	<h5 class="d-inline">| Questions: {{ $tag->questions_count }}</h5>
</div>

<ul class="nav nav-tabs mb-2">
	<li class="nav-item">
		<a href="{{ route('admin.tags.info', $tag->slug) }}" class="nav-link @yield('info')">
			Information
		</a>
	</li>
	<li class="nav-item">
		<a href="{{ route('admin.tags.questions', $tag->slug) }}" class="nav-link @yield('questions')">
			Questions
		</a>
	</li>
</ul>

@yield('tab_content')

@endsection

@section('right_sidebar')
	@admin
		<li class="list-group-item">
		  <a class="btn btn-info" href="{{ route('admin.tags.edit', $tag->slug) }}">Edit</a>
		</li>
	
		<form action="{{ route('admin.tags.destroy', $tag->slug) }}" method="POST">
			@method('DELETE')
			@csrf

			<li class="list-group-item">
			  <button type="submit" class="btn btn-danger">Delete</button>
			</li>  	  

		</form>
	@endadmin
@endsection
