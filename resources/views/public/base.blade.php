@extends('layouts.base')

@section('brand_title', 'Toaster')

@section('left_sidebar')

	@auth
		<a class="list-group-item"
		href="{{ route('questions.feed') }}">
			My feed
		</a>
	@endauth

	<a href="{{ route('questions.index') }}" class="list-group-item">
		All questions
	</a>	

	<a href="{{ route('tags.index') }}" class="list-group-item">
		All tags
	</a>	

	<a href="{{ route('users.index') }}" class="list-group-item">
		Users
	</a>	

	@moderator
		<a class="list-group-item"
		href="{{ route('admin.questions.index') }}">
			<button class="btn btn-primary"> To admin panel</button>
		</a>		
	@endmoderator

@endsection

@section('base_content')
	@include('public.components.messages.base')
	@yield('content')
@endsection