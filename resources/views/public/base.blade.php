@extends('layouts.base')

@section('brand_title', 'Toaster')

@section('left_sidebar')

	@auth
		<a class="list-group-item list-group-item-action text-light bg-dark"
		href="{{ route('questions.index') }}">
			My feed
		</a>
	@endauth

	<a href="{{ route('questions.index') }}" class="list-group-item list-group-item-action text-light bg-dark">
		All questions
	</a>	

	<a href="{{ route('tags.index') }}" class="list-group-item list-group-item-action text-light bg-dark">
		All tags
	</a>	

	<a href="{{ route('users.index') }}" class="list-group-item list-group-item-action text-light bg-dark">
		Users
	</a>	

	@moderator
		<a class="list-group-item list-group-item-action text-light bg-dark"
		href="{{ route('admin.questions.index') }}">
			<button class="btn btn-primary"> To admin panel</button>
		</a>		
	@endmoderator

@endsection

@section('base_content')
	@include('public.includes.messages.base')
	@yield('content')
@endsection