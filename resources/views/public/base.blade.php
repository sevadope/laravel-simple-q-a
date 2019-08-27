@extends('layouts.base')

@section('brand_title', 'Toaster')

@section('left_sidebar')
	
	@moderator
		<a class="list-group-item list-group-item-action text-light bg-dark"
		href="{{ route('admin.questions.index') }}">
			To admin panel
		</a>		
	@endmoderator

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

@endsection

@section('base_content')
	@include('public.includes.messages.base')
	@yield('content')
@endsection